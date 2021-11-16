<?php
namespace Packaged\Remarkdown\Rules;

class TipText implements RemarkdownRule
{
  public function apply(string $text): string
  {
    return preg_replace_callback('/\{(.*?)\}\((.*?)\)/', function ($matches) {
      return '<span title="' . $matches[1] . '">' . $matches[2] . '</a>';
    }, $text);
  }
}
