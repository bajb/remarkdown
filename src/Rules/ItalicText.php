<?php
namespace Packaged\Remarkdown\Rules;

class ItalicText implements RemarkdownRule
{
  public function apply(string $text): string
  {
    return preg_replace_callback('/\/\/(.+?)\/\/|\*(.+?)\*|_(.+?)_/', function (array $matches) {
      return '<em>' . ($matches[3] ?? $matches[2] ?? $matches[1]) . '</em>';
    }, $text);
  }
}
