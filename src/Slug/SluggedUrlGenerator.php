<?php

namespace Demontpx\UtilBundle\Slug;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
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

    public function generate(SluggableInterface $sluggable, array $parameterList = []): string
    {
        $configuration = $this->sluggableManager->getConfiguration($sluggable);

        $parameterList[$configuration->getRouteIdParameterName()] = $sluggable->getSlugId();
        $parameterList[$configuration->getRouteSlugParameterName()] = $this->slugger->slug($sluggable);

        return $this->urlGenerator->generate($configuration->getRouteName(), $parameterList);
    }
}
