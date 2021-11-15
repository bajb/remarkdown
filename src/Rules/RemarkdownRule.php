<?php
namespace Packaged\Remarkdown\Rules;

interface RemarkdownRule
{
  public function apply(string $text): string;
}
