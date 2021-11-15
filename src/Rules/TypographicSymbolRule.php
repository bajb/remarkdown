<?php
namespace Packaged\Remarkdown\Rules;

class TypographicSymbolRule implements RemarkdownRule
{
  protected static $_symbols = [
    'c'  => '©',
    'C'  => '©',
    'r'  => '®',
    'R'  => '®',
    'tm' => '™',
    'TM' => '™',
    'p'  => '§',
    'P'  => '§',
    '+-' => '±',
  ];

  public function apply(string $text): string
  {
    return preg_replace_callback('/\((\S{1,2})\)/', function (array $matches) {
      return self::$_symbols[str_replace('-', '_', $matches[1])] ?? $matches[0];
    }, $text);
  }
}
