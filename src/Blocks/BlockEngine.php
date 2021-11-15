<?php
namespace Packaged\Remarkdown\Blocks;

use Packaged\Remarkdown\Rules\RuleEngine;

class BlockEngine
{
  protected $_engine;

  public function __construct(RuleEngine $engine)
  {
    $this->_engine = $engine;
  }

  public function parseLines(array $lines, $subBlock = false)
  {
    $blocks = [];
    $currentBlock = null;
    foreach($lines as $line)
    {
      if(isset($line[0]) && ($line === '***' || $line === '___' || ($line[0] === '-'
            && preg_match('/^-{3,}$/', $line))))
      {
        $line = '<hr/>';
      }

      if($currentBlock !== null)
      {
        //Attempt to add the line to the current block
        if($currentBlock->addNewLine($line))
        {
          //line added, continue to the next
          continue;
        }
        else
        {
          $blocks[] = $currentBlock->complete($this, $this->_engine);
          $currentBlock = false;
        }
      }

      if($currentBlock === null)
      {
        $currentBlock = $this->_detectBlock($line, $subBlock);
        if($currentBlock !== null)
        {
          $currentBlock->addNewLine($line);
        }
        else
        {
          $blocks[] = $line;
        }
      }
      else if($currentBlock === false)
      {
        $currentBlock = null;
      }
    }
    if($currentBlock !== null)
    {
      $blocks[] = $currentBlock->complete($this, $this->_engine);
    }
    return $blocks;
  }

  protected function _detectBlock($line, $subBlock = false): ?BlockInterface
  {
    if(empty($line))
    {
      return null;
    }

    if($line[0] === "\t" || ($line[0] == ' ' && substr($line, 0, 4) == '    '))
    {
      return new CodeBlock();
    }

    $line = ltrim($line, "\t\r\n\0\x0B ");

    switch($line[0] . ($line[1] ?? ' '))
    {
      case '# ':
      case '##':
        return new HeadingBlock();
      case '| ':
        return new TableBlock();
      case '> ':
      case '>>':
        return new BlockQuote();
      case '``':
        return new CodeBlock();
      case "0 ":
      case "1 ":
      case "2 ":
      case "3 ":
      case "4 ":
      case "5 ":
      case "6 ":
      case "7 ":
      case "8 ":
      case "9 ":
      case "0.":
      case "1.":
      case "2.":
      case "3.":
      case "4.":
      case "5.":
      case "6.":
      case "7.":
      case "8.":
      case "9.":
        return new OrderedListBlock();
      case '- ':
      case '* ':
      case '+ ':
        return new UnorderedListBlock();
    }

    $matches = [];
    if(preg_match('/\(?(SUCCESS|WARNING|NOTE|NOTICE|IMPORTANT|DANGER)([:|]?\)?)/', $line, $matches))
    {
      return new HintBlock($matches[1], $matches[2]);
    }

    if($subBlock)
    {
      return null;
    }

    if(preg_match('/[a-zA-Z0-9_*`!~]/', $line[0]))
    {
      return new ParagraphBlock();
    }
    return null;
    return new Block();
  }
}
