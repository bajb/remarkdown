<?php
$start = microtime(true);

use Packaged\Remarkd\Remarkd;

require "../vendor/autoload.php";
$markdown = new Remarkd();
$source = $_POST['markdown'] ?? file_get_contents(($_GET['file'] ?? 'remark') . '.md');
?>
<form method="post" style="display:flex; flex-direction:column;flex-grow: 1; flex-basis: 50%;  max-width: 1024px;">
  <textarea name="markdown" style="flex-grow:1;flex-basis: 100%;"><?= $source; ?></textarea>
  <input type="submit" value="Render"
         style="flex-grow: 1; flex-basis: 100px; padding: 10px; text-align: center; font-size: 20px;">
</form>
<br>
<br>
<?php

try
{
  echo '<div class="markdown" style="flex-basis: 50%; ">';
  echo $markdown->parse($source);
  echo '</div>';
}
catch(Exception $e)
{
  var_dump($e);
}

$exec = microtime(true) - $start;
echo '<span class="time">' . round($exec * 1000, 5) . ' ms</span>';
?>
<style>
    html {
        display: flex;
        justify-content: center;
    }

    body {
        display: flex;
        flex-grow: 1;
        flex-direction: row;
        font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji;
        font-size: 16px;
        line-height: 1.5;
        word-wrap: break-word;
        font-weight: 300;
        color: rgba(0, 0, 0, 0.87);
    }

    .markdown {
        max-width: 1024px;
        max-height: 100%;
        overflow: auto;
        padding: 10px 10px 30px 10px;
        margin: 20px;
    }

    body img {
        max-width: 35%;
    }

    h1, h2, h3, h4, h5, h6 {
        margin: 24px 0 16px 0;
        font-weight: 600;
        line-height: 1.25;
    }

    h1 {
        font-size: 2em;
    }

    }
    h2 {
        font-size: 1.25em;
    }

    h3 {
        font-size: 1em;
    }

    h4 {
        font-size: .875em;
    }

    h5, h6 {
        font-size: .85em;
    }

    h6 {
        color: #57606a;
    }

    h1, h2 {
        padding-bottom: 3px;
        border-bottom: 1px solid #d8dee4;
    }

    hr {
        border: none;
        border-top: 1px solid rgba(0, 0, 0, 0.5);
        margin: 10px 0;
    }

    blockquote {
        border-left: 3px solid #a7b5bf;
        color: #464C5C;
        font-style: italic;
        margin: 4px 0 12px 0;
        padding: 8px 12px;
        background-color: rgba(50, 80, 150, 0.05);
    }

    code {
        line-height: inherit;
        background: rgba(71, 87, 120, 0.08);
        display: block;
        color: #000;
        overflow: auto;
        padding: 12px;
        border-radius: 3px;
        white-space: pre;
    }

    kbd {
        display: inline-block;
        min-width: 1em;
        padding: 4px 5px 5px;
        font-weight: normal;
        font-size: 0.8rem;
        text-align: center;
        text-decoration: none;
        line-height: 0.6rem;
        border-radius: 3px;
        box-shadow: inset 0 -1px 0 rgba(71, 87, 120, 0.08);
        user-select: none;
        background: #F7F7F7;
        border: 1px solid #C7CCD9;
    }

    .time {
        position: fixed;
        top: 0;
        right: 0;
        padding: 2px 5px;
        font-size: 12px;
        font-weight: bold;
        background: #eee;
        opacity: 0.5;
    }

    .monospace {
        display: inline-block;
        font-family: monospace;
        color: #000;
        background: rgba(71, 87, 120, 0.1);
        padding: 1px 4px;
        border-radius: 3px;
        white-space: pre-wrap;
    }

    .highlight {
        display: inline-block;
        background-color: #dfeff1;
        padding: 0 4px;
    }

    .hint-tip {
        position: relative;
        margin: 16px 0;
        padding: 12px;
        border: 1px solid #63b7de;
        border-radius: 3px;
        background: #e7f5f9;
        padding-left: 50px;
    }

    .hint-tip:before {
        content: '';
        position: absolute;
        background: url("./magic.svg") no-repeat center center;
        top: 8px;
        left: 10px;
        width: 25px;
        height: 100%;
        max-height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }


    .hint-important .hint-caption, .hint-danger .hint-caption {
        color: #c0392b;
    }

    .hint-important, .hint-danger {
        margin: 16px 0;
        padding: 12px;
        border-left: 3px solid #c0392b;
        background: #f4dddb;
    }

    .hint-note .hint-caption, .hint-notice .hint-caption {
        color: #276bae;
    }

    .hint-note, .hint-notice {
        margin: 16px 0;
        padding: 12px;
        border-left: 3px solid #276bae;
        background: #e6f0f7;
    }

    .hint-success .hint-caption {
        color: #17964b;
    }

    .hint-success {
        margin: 16px 0;
        padding: 12px;
        border-left: 3px solid #17964b;
        background: #e6f7e6;
    }

    .hint-warning .hint-caption {
        color: #f18f0f;
    }

    .hint-warning {
        margin: 16px 0;
        padding: 12px;
        border-left: 3px solid #f18f0f;
        background: #fcf3e3;
    }

    table {
        border-collapse: separate;
        border-spacing: 1px;
        background: #BFCFDA;
        margin: 12px 0;
        word-break: normal;
    }

    table th, table td {
        text-align: left;
    }

    table th {
        font-weight: bold;
        padding: 4px 6px;
        background: #F8F9FC;
    }

    table td {
        background: #fff;
        padding: 3px 6px;
    }

    ul.tab-header {
        display: flex;
        border-bottom: 1px solid #d8dee4;
        margin-bottom: 0;
        padding: 0;
    }

    ul.tab-header li {
        display: block;
    }

    ul.tab-header li a {
        color: #000000;
        padding: 10px;
        text-align: center;
        display: block;
        border-bottom: 2px solid transparent;
        text-decoration: none;
    }


    ul.tab-header li a:hover {
        border-bottom-color: rgba(143, 143, 143, 0.2);
    }

    ul.tab-header li a.active {
        border-bottom-color: #5c7ef6;
        font-weight: 600;
    }

    .tabs {
    }

    .tabs .tab {
        display: none;
        padding: 10px;
    }

    .tabs .tab:first-of-type {
        display: block;
    }

    .video-container {
        position: relative;
        overflow: hidden;
        width: 100%;
        padding-top: 56.25%; /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
    }

    .tooltip {
        border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
    }

    .well {
        border: 1px solid rgba(0, 0, 0, 0.04);
        background: rgba(0, 0, 0, 0.03);
        border-radius: 6px;
        padding: 15px;
    }
</style>
<script>
  document.addEventListener('click', function (e) {
    var tab = e.target.getAttribute('data-tab-focus-key');
    if(tab)
    {
      setActiveTab(tab);
      e.preventDefault();
    }
  });

  function setActiveTab(tabKey)
  {
    let tabs = document.querySelectorAll('.tabs .tab[data-tab-key=' + tabKey + ']');
    tabs.forEach(function (tab) {
      let tabGroup = tab.parentNode.parentNode;
      tabGroup.querySelectorAll('.tab-header li a').forEach(function (tabHeader) {
        if(tabHeader.getAttribute('data-tab-focus-key') === tabKey)
        {
          tabHeader.classList.add('active');
        }
        else
        {
          tabHeader.classList.remove('active');
        }
      });
      tab.parentNode.querySelectorAll('.tab').forEach(function (otab) {
        otab.style.display = 'none';
      });
      tab.style.display = 'block';
    });
  }
</script>
