<?php
namespace Packaged\Remarkdown\Rules;

class AsciimojiRule implements RemarkdownRule
{
  //data source : http://asciimoji.com/
  protected static $_emoji = [
    'afraid' => '(ㆆ _ ㆆ)',
    'angry'  => '•`_´•',
    'pooh'   => 'ʕ •́؈•̀)',
  ];

  public function apply(string $text): string
  {
    return preg_replace_callback('/:\((\S+)\):/', function (array $matches) {
      return self::$_emoji[str_replace('-', '_', $matches[1])] ?? $matches[0];
    }, $text);
  }
}
