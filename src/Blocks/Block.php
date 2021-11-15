<?php
namespace Packaged\Remarkdown\Blocks;

use Packaged\Remarkdown\Rules\RuleEngine;

class Block implements BlockInterface
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
    return $ruleEngine->parse(str_replace("<hr/>\n<br/>", '<hr/>', implode("\n<br/>", $this->_lines)));
  }
}
