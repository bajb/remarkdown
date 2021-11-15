<?php
namespace Packaged\Remarkdown;

use Packaged\Remarkdown\Blocks\BlockEngine;
use Packaged\Remarkdown\Rules\AsciimojiRule;
use Packaged\Remarkdown\Rules\BoldText;
use Packaged\Remarkdown\Rules\CheckboxRule;
use Packaged\Remarkdown\Rules\DeletedText;
use Packaged\Remarkdown\Rules\EmojiRule;
use Packaged\Remarkdown\Rules\HighlightText;
use Packaged\Remarkdown\Rules\ItalicText;
use Packaged\Remarkdown\Rules\KeyboardKey;
use Packaged\Remarkdown\Rules\LinkText;
use Packaged\Remarkdown\Rules\MonospacedText;
use Packaged\Remarkdown\Rules\RuleEngine;
use Packaged\Remarkdown\Rules\TypographicSymbolRule;
use Packaged\Remarkdown\Rules\UnderlinedText;

class Remarkdown
{
  /** @var \Packaged\Remarkdown\Rules\RuleEngine */
  protected $_ruleEngine;
  protected $_blockEngine;

  public function __construct()
  {
    $this->_ruleEngine = $this->createEngine();
    $this->_blockEngine = new BlockEngine($this->_ruleEngine);
  }

  public function parse($text)
  {
    $lines = explode("\n", $text);
    $blocks = $this->_blockEngine->parseLines($lines);
    return $this->_ruleEngine->parse(implode("", $blocks));
  }

  public function createEngine(): RuleEngine
  {
    $engine = new RuleEngine();
    $engine->registerRule(new MonospacedText());
    $engine->registerRule(new UnderlinedText());//must be before bold

    $engine->registerRule(new AsciimojiRule());
    $engine->registerRule(new TypographicSymbolRule());
    $engine->registerRule(new EmojiRule());
    $engine->registerRule(new KeyboardKey());

    $engine->registerRule(new LinkText());
    $engine->registerRule(new BoldText());
    $engine->registerRule(new ItalicText());
    $engine->registerRule(new DeletedText());
    $engine->registerRule(new HighlightText());

    $engine->registerRule(new CheckboxRule());

    return $engine;
  }
}
