<?php

namespace Demontpx\UtilBundle\Slug;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class SluggedUrlGenerator
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2015 Bert Hekman
 */
class SluggedUrlGenerator
{
    /** @var SluggableManager */
    private $sluggableManager;

    /** @var UrlGeneratorInterface */
    private $urlGenerator;

    /** @var SluggerInterface */
    private $slugger;

    /**
     * @param SluggableManager      $sluggableManager
     * @param UrlGeneratorInterface $urlGenerator
     * @param SluggerInterface      $slugger
     */
    public function __construct(
        SluggableManager $sluggableManager,
        UrlGeneratorInterface $urlGenerator,
        SluggerInterface $slugger
    )
    {
        $this->sluggableManager = $sluggableManager;
        $this->urlGenerator = $urlGenerator;
        $this->slugger = $slugger;
    }

    /**
     * @param SluggableInterface $sluggable
     * @param array              $parameterList
     *
     * @return string
     */
    public function generate(SluggableInterface $sluggable, array $parameterList = [])
    {
        $configuration = $this->sluggableManager->getConfiguration($sluggable);

        $parameterList[$configuration->getRouteIdParameterName()] = $sluggable->getId();
        $parameterList[$configuration->getRouteSlugParameterName()] = $this->slugger->slug($sluggable);

        return $this->urlGenerator->generate($configuration->getRouteName(), $parameterList);
    }
}
