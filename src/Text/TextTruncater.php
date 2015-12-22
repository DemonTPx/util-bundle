<?php

namespace Demontpx\UtilBundle\Text;

/**
 * Class TextTruncater
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2015 Bert Hekman
 */
class TextTruncater
{
    /** @var string */
    private $charset;

    /**
     * @param string $charset
     */
    public function __construct($charset)
    {
        $this->charset = $charset;
    }

    /**
     * @param string $value
     * @param int    $length
     * @param bool   $preserve
     * @param string $separator
     *
     * @return string
     */
    public function truncate($value, $length = 30, $preserve = false, $separator = '...')
    {
        if (mb_strlen($value, $this->charset) > $length) {
            if ($preserve) {
                // If breakpoint is on the last word, return the value without separator.
                if (($breakpoint = mb_strpos($value, ' ', $length, $this->charset)) === false) {
                    return $value;
                }

                $length = $breakpoint;
            }

            return rtrim(mb_substr($value, 0, $length, $this->charset)).$separator;
        }

        return $value;
    }
}
