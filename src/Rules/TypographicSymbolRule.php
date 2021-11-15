<?php
namespace Packaged\Remarkdown\Rules;

class TypographicSymbolRule implements RemarkdownRule
{
  public function apply(string $text): string
  {
    return str_replace(
      ['(c)', '(C)', '(r)', '(R)', '(tm)', '(TM)', '(p)', '(P)', '(+-)',],
      ['©', '©', '®', '®', '™', '™', '§', '§', '±',],
      $text
    );
  }
}
