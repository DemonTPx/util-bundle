<?php

namespace Demontpx\UtilBundle\Twig;

/**
 * Class DateShortExtension
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class DateShortExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
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
            return $date->format('H:i');
        }

        if ($now->format('Y') == $date->format('Y')) {
            return strtolower($date->format('j M.'));
        }

        return $date->format('d-m-y');
    }

    /**
     * @param \DateTime $date
     *
     * @return string
     */
    public function dateShortHover(\DateTime $date)
    {
        return sprintf('<span title="%s">%s</span>', $date->format('D j F Y, G:i'), $this->dateShort($date));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'date_short';
    }
}
