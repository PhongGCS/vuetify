<?php

namespace ConceptualStudio\Utils;


use \HtmlTruncator\Truncator;

/**
 * Class Excerpt
 *
 * An utility that provides an Excerpt support.
 *
 * @package ConceptualStudio\Utils
 */
class Excerpt {

    public static function getExcerpt($string, $length, $byWords = true, $append = "...")
    {
        if ($byWords)
            return Truncator::truncate($string, $length, array('length_in_chars' => false, 'ellipsis' => $append));
        else
            return Truncator::truncate($string, $length, array('length_in_chars' => true, 'ellipsis' => $append));
    }

    public static function getExcerptByWords($string, $length, $append = "...") {
        return Excerpt::getExcerpt($string, $length, true, $append);
    }

    public static function getExcerptByCharacters($string, $length, $append = "...") {
        return Excerpt::getExcerpt($string, $length, false, $append);
    }

}