<?php

namespace Demontpx\UtilBundle\Twig;

use Demontpx\UtilBundle\Intl\SimpleDateFormatter;

/**
 * @copyright 2014 Bert Hekman
 */
class DateShortExtension extends \Twig_Extension
{
    /** @var SimpleDateFormatter */
    private $formatter;

    public function __construct(SimpleDateFormatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public function getFilters()
    {
        return [
            new \Twig_Filter('date_short', [$this, 'dateShort'], ['is_safe' => ['html']]),
            new \Twig_Filter('date_short_hover', [$this, 'dateShortHover'], ['is_safe' => ['html']]),
        ];
    }

    public function dateShort(\DateTime $date): string
    {
        $now = new \DateTime();

        if ($now->format('Y-m-d') == $date->format('Y-m-d')) {
            return $this->formatter->time($date, SimpleDateFormatter::SHORT);
        }

        if ($now->format('Y') == $date->format('Y')) {
            $result = $this->formatter->date($date, SimpleDateFormatter::MEDIUM);

            if (($pos = strrpos($result, $now->format('Y'))) !== 0) {
                $result = trim(substr($result, 0, $pos), ', ');
            }

            return $result;
        }

        return $this->formatter->date($date, SimpleDateFormatter::SHORT);
    }

    public function dateShortHover(\DateTime $date): string
    {
        $fullDate = $this->formatter->date($date, SimpleDateFormatter::FULL) . ', ' .
            $this->formatter->time($date, SimpleDateFormatter::SHORT);

        return sprintf('<span title="%s">%s</span>', $fullDate, $this->dateShort($date));
    }
}
