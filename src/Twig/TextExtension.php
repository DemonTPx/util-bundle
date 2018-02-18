<?php

namespace Demontpx\UtilBundle\Twig;

use Demontpx\UtilBundle\Text\TextTruncater;

/**
 * @copyright 2015 Bert Hekman
 */
class TextExtension extends \Twig_Extension
{
    /** @var TextTruncater */
    private $truncater;

    public function __construct(TextTruncater $truncater)
    {
        $this->truncater = $truncater;
    }

    public function getFilters()
    {
        return [
            new \Twig_Filter('truncate', [$this->truncater, 'truncate']),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_Function('truncate', [$this->truncater, 'truncate']),
        ];
    }
}
