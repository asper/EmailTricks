<?php

/**
 * Charset used in the mail
 */
if ( !defined('EMAIL_TRICKS_CHARSET') ) {
    define('EMAIL_TRICKS_CHARSET', 'UTF-8');
}

/**
 * Assets host
 */
if ( !defined('EMAIL_TRICKS_HOST') ) {
    define('EMAIL_TRICKS_HOST', $_SERVER['HTTP_HOST']);
}

/**
 * Assets path form the host root
 */
if ( !defined('EMAIL_TRICKS_PATH') ) {
    define('EMAIL_TRICKS_PATH', '/');
}

/**
 * Shorthand class
 */
if ( !defined('EMAIL_TRICKS_SHORT_CLASS') || EMAIL_TRICKS_SHORT_CLASS ) {
    class ET extends EmailTricks {}
}

/**
 * EmailTricks Class
 */
class EmailTricks {
    
/**
 * Entities method shortcut
 **/
    public static function e( $text = null, $nl2br = false ) {
        return self::entities($text);
    }

/**
 * Encode htmlentities
 */
    public static function entities( $text = null, $nl2br = false ) {
        $text = htmlentities($string, ENT_COMPAT, EMAIL_TRICKS_CHARSET);
        if ($nl2br) {
            $text = nl2br($text);
        }
		return $text;
	}

/**
 * Replace absolute urls by relative ones
 */
    public static function absolutize ( $html = null ) {
        $regexp = '/(src|href)\w*?=\w*?"|\'(\.|\/|[a-z0-9]*?)"|\'/i';
        $html = preg_replace_callback($regexp, array(self, absolutizeReplace), $html);
        return $html;
    }

/**
 * Absolutize replace callback
 */    
    public static function absoltiseReplace ( $matches ) {
        if ( $matches[2]{0} != '/' ) {
            $matches[2] = EMAIL_TRICKS_PATH.'/'.ltrim($matches[2], './');
        }
        return $matches[1].'="'.EMAIL_TRICKS_HOST.$matches[2].'"';
    }

/**
 * Images
 */
    public static function images ( $html = null, $options = array() ) {
        $defaults = array(
            'size' => false,
            'alt' => true,
            'block' => true
        );
        $options = array_merge( $defaults, $options );
        // TODO
    }
    

	
}