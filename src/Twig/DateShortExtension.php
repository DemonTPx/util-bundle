<?php

namespace Demontpx\UtilBundle\Twig;

use Demontpx\UtilBundle\Intl\SimpleDateFormatter;

/**
 * Class DateShortExtension
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class DateShortExtension extends \Twig_Extension
{
    /** @var SimpleDateFormatter */
    private $formatter;

    /**
     * @param SimpleDateFormatter $formatter
     */
    public function __construct(SimpleDateFormatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('date_short', array($this, 'dateShort'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('date_short_hover', array($this, 'dateShortHover'), array('is_safe' => array('html'))),
        );
    }

    /**
     * @param \DateTime $date
     *
     * @return string
     */
    public function dateShort(\DateTime $date)
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

    /**
     * @param \DateTime $date
     *
     * @return string
     */
    public function dateShortHover(\DateTime $date)
    {
        $fullDate = $this->formatter->date($date, SimpleDateFormatter::FULL) . ', ' .
            $this->formatter->time($date, SimpleDateFormatter::SHORT);

        return sprintf('<span title="%s">%s</span>', $fullDate, $this->dateShort($date));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'date_short';
    }
}
