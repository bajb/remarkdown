<?php
namespace Packaged\Remarkdown\Blocks;

use Packaged\Remarkdown\Rules\RuleEngine;

class HeadingBlock implements BlockInterface
{
  protected $_lines = [];
  protected $_level;

  public function addNewLine(string $line)
  {
    if(empty($line) || !empty($this->_lines))
    {
      return false;
    }

    $this->_level = substr_count($line, '#', 0);
    $this->_lines[] = substr(trim($line), $this->_level);
    return true;
  }

  public function complete(BlockEngine $blockEngine, RuleEngine $ruleEngine): string
  {
    return $ruleEngine->parse('<h' . $this->_level . '>' . implode("\n", $this->_lines) . '</h' . $this->_level . '>');
  }
}
