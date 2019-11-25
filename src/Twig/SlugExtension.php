<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Twig;

use Demontpx\UtilBundle\Slug\SluggedUrlGenerator;
use Demontpx\UtilBundle\Slug\SluggerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * @copyright 2015 Bert Hekman
 */
class SlugExtension extends AbstractExtension
{
    /** @var SluggerInterface */
    private $slugger;
    /** @var SluggedUrlGenerator */
    private $urlGenerator;

    public function __construct(SluggerInterface $slugger, SluggedUrlGenerator $urlGenerator)
    {
        $this->slugger = $slugger;
        $this->urlGenerator = $urlGenerator;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('slug', [$this->slugger, 'slug']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('slug', [$this->slugger, 'slug']),
            new TwigFunction('path_sluggable', [$this->urlGenerator, 'generate']),
        ];
    }
}
