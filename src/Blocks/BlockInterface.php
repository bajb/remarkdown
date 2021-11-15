<?php
namespace Packaged\Remarkdown\Blocks;

use Packaged\Remarkdown\Rules\RuleEngine;

interface BlockInterface
{
  public function addNewLine(string $line);

  public function complete(BlockEngine $blockEngine, RuleEngine $ruleEngine): string;
}
