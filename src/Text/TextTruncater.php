<?php

namespace Demontpx\UtilBundle\Text;

/**
 * @copyright 2015 Bert Hekman
 */
class TextTruncater
{
    /** @var string */
    private $charset;

    public function __construct(string $charset)
    {
        $this->charset = $charset;
    }

    public function truncate(string $value, int $length = 30, bool $preserve = false, string $separator = '...'): string
    {
        if (mb_strlen($value, $this->charset) > $length) {
            if ($preserve) {
                // If breakpoint is on the last word, return the value without separator.
                if (($breakpoint = mb_strpos($value, ' ', $length, $this->charset)) === false) {
                    return $value;
                }

                $length = $breakpoint;
            }

            return rtrim(mb_substr($value, 0, $length, $this->charset)) . $separator;
        }

        return $value;
    }
}
