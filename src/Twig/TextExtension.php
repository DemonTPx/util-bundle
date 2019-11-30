<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Twig;

use Demontpx\UtilBundle\Text\TextTruncater;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * @copyright 2015 Bert Hekman
 */
class TextExtension extends AbstractExtension
{
    private TextTruncater $truncater;

    public function __construct(TextTruncater $truncater)
    {
        $this->truncater = $truncater;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('truncate', [$this->truncater, 'truncate']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('truncate', [$this->truncater, 'truncate']),
        ];
    }
}
