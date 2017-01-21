<?php
class BBCodeClass
{
  
  public function BBCodeM($text)
  {
    $text = trim($text);

    // BBCode [code]
    if (!function_exists('escape')) {
      function escape($s) {
        global $text;
        $text = strip_tags($text);
        $code = $s[1];
        $code = htmlspecialchars($code);
        $code = str_replace("[", "&#91;", $code);
        $code = str_replace("]", "&#93;", $code);
        return '<pre><code>'.$code.'</code></pre>';
      }
    }
    $text = preg_replace_callback('/\[code\](.*?)\[\/code\]/ms', "escape", $text);

    // Smileys to find...
    $in = array( 	 ':)',
             ':D',
             ':o',
             ':p',
             ':(',
             ';)'
    );
    // And replace them by...
    $out = array(	 '<img alt=":)" src="'.EMOTICONS_DIR.'emoticon_happy.png" />',
             '<img alt=":D" src="'.EMOTICONS_DIR.'emoticon_smile.png" />',
             '<img alt=":o" src="'.EMOTICONS_DIR.'emoticon_surprised.png" />',
             '<img alt=":p" src="'.EMOTICONS_DIR.'emoticon_tongue.png" />',
             '<img alt=":(" src="'.EMOTICONS_DIR.'emoticon_unhappy.png" />',
             '<img alt=";)" src="'.EMOTICONS_DIR.'emoticon_wink.png" />'
    );
    $text = str_replace($in, $out, $text);

    // BBCode to find...
    $in = array( 	 '/\[b\](.*?)\[\/b\]/ms',
             '/\[i\](.*?)\[\/i\]/ms',
             '/\[u\](.*?)\[\/u\]/ms'
    );
    // And replace them by...
    $out = array(	 '<strong>\1</strong>',
             '<em>\1</em>',
             '<u>\1</u>'
    );
    $text = preg_replace($in, $out, $text);

    // paragraphs
    $text = str_replace("\r", "", $text);
    $text = "".preg_replace("/(\n){2,}/", "", $text)."";
    $text = nl2br($text);

    // clean some tags to remain strict
    // not very elegant, but it works. No time to do better ;)
    if (!function_exists('removeBr')) {
      function removeBr($s) {
        return str_replace("<br />", "", $s[0]);
      }
    }
    $text = preg_replace_callback('/<pre>(.*?)<\/pre>/ms', "removeBr", $text);
    $text = preg_replace('/<p><pre>(.*?)<\/pre><\/p>/ms', "<pre>\\1</pre>", $text);

    $text = preg_replace_callback('/<ul>(.*?)<\/ul>/ms', "removeBr", $text);
    $text = preg_replace('/<p><ul>(.*?)<\/ul><\/p>/ms', "<ul>\\1</ul>", $text);

    return $text;
  }

}