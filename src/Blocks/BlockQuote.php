<?php
namespace Packaged\Remarkdown\Blocks;

use Packaged\Remarkdown\Rules\RuleEngine;

class BlockQuote implements BlockInterface
{
  protected $_lines = [];

  public function addNewLine(string $line)
  {
    $line = ltrim($line, "\t\r\n\0\x0B ");
    if(empty($line) || $line[0] !== '>')
    {
      return false;
    }
    $this->_lines[] = substr($line, 1);
    return true;
  }

  public function complete(BlockEngine $blockEngine, RuleEngine $ruleEngine): string
  {
    $lines = $blockEngine->parseLines($this->_lines, true);
    return '<blockquote>' . implode("<br/>", $lines) . '</blockquote>';
  }
}
