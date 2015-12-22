<?php

namespace Demontpx\UtilBundle\Twig;

use Demontpx\UtilBundle\Text\TextTruncater;

/**
 * Class TextExtension
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2015 Bert Hekman
 */
class TextExtension
{
    /** @var TextTruncater */
    private $truncater;

    /**
     * @param TextTruncater $truncater
     */
    public function __construct(TextTruncater $truncater)
    {
        $this->truncater = $truncater;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('truncate', [$this->truncater, 'truncate']),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('truncate', [$this->truncater, 'truncate']),
        ];
    }

    public function getName()
    {
        return 'demontpx_util_text';
    }
}
