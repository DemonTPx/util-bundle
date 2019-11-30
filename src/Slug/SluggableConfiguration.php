<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Slug;

/**
 * @copyright 2015 Bert Hekman
 */
class SluggableConfiguration
{
    private string $className;
    private string $routeName;
    private string $routeIdParameterName;
    private string $routeSlugParameterName;

    public function __construct(
        string $className,
        string $routeName,
        string $routeIdParameterName = 'id',
        string $routeSlugParameterName = 'slug'
    )
    {
        $this->className = $className;
        $this->routeName = $routeName;
        $this->routeIdParameterName = $routeIdParameterName;
        $this->routeSlugParameterName = $routeSlugParameterName;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getRouteName(): string
    {
        return $this->routeName;
    }

    public function getRouteIdParameterName(): string
    {
        return $this->routeIdParameterName;
    }

    public function getRouteSlugParameterName(): string
    {
        return $this->routeSlugParameterName;
    }
}
