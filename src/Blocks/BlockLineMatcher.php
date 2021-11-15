<?php
namespace Packaged\Remarkdown\Blocks;

interface BlockLineMatcher
{
  public function match(string $line, bool $nested): ?BlockInterface;
}
