<?php
namespace Packaged\Remarkdown\Rules;

class CheckboxRule implements RemarkdownRule
{
  public function apply(string $text): string
  {
    return str_replace(
      [
        '[ ]',
        '[x]',
      ],
      [
        '<input type="checkbox" onclick="return false;">',
        '<input type="checkbox" onclick="return false;" checked>',
      ],
      $text
    );
  }
}
