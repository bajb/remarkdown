<?php
namespace Packaged\Remarkdown\Blocks;

use Packaged\Remarkdown\Rules\RuleEngine;

class ParagraphBlock implements BlockInterface
{
  protected $_lines = [];

  public function addNewLine(string $line)
  {
    if(empty($line))
    {
      return false;
    }
    $this->_lines[] = $line;
    return true;
  }

  public function complete(BlockEngine $blockEngine, RuleEngine $ruleEngine): string
  {
    return '<p>' . $ruleEngine->parse(implode("\n<br/>", $this->_lines)) . '</p>';
  }
}
