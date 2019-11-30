<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Slug;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @copyright 2015 Bert Hekman
 */
class SluggedUrlGenerator
{
    private SluggableManager $sluggableManager;
    private UrlGeneratorInterface $urlGenerator;
    private SluggerInterface $slugger;

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
