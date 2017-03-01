<?php

namespace Demontpx\UtilBundle\Twig;

use Demontpx\UtilBundle\Slug\SluggedUrlGenerator;
use Demontpx\UtilBundle\Slug\SluggerInterface;

/**
 * Class SlugExtension
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2015 Bert Hekman
 */
class SlugExtension extends \Twig_Extension
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
            new \Twig_SimpleFilter('slug', [$this->slugger, 'slug']),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('slug', [$this->slugger, 'slug']),
            new \Twig_SimpleFunction('path_sluggable', [$this->urlGenerator, 'generate']),
        ];
    }
}
