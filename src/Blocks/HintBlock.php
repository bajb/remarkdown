<?php
namespace Packaged\Remarkdown\Blocks;

use Packaged\Remarkdown\Rules\RuleEngine;

class HintBlock implements BlockInterface
{
  protected $_lines = [];
  protected $_style;
  protected $_levelLen;
  protected $_level;

  public function __construct($level, $style)
  {
    $this->_level = $level;
    $this->_style = $style;
    $this->_levelLen = strlen($level);
  }

  public function addNewLine(string $line)
  {
    if(empty($line) || ($this->_style !== '|' && !empty($this->_lines)))
    {
      return false;
    }

    if($this->_style === '|' && substr($line, 0, $this->_levelLen) !== $this->_level)
    {
      return false;
    }

    $this->_lines[] = substr($line, $this->_levelLen + ($this->_style === ')' ? 2 : 1));
    return true;
  }

  public function complete(BlockEngine $blockEngine, RuleEngine $ruleEngine): string
  {
    return $ruleEngine->parse(
      '<div class="hint-' . strtolower($this->_level) . '">'
      . ($this->_style === ':' ? '<strong class="hint-caption">' . $this->_level . '</strong>' : '')
      . implode("\n<br/>", $this->_lines) . '</div>'
    );
  }
}
