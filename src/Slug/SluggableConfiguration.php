<?php

namespace Demontpx\UtilBundle\Slug;

/**
 * Class SluggableManager
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2015 Bert Hekman
 */
class SluggableConfiguration
{
    /** @var string */
    private $className;

    /** @var string */
    private $routeName;

    /** @var string */
    private $routeIdParameterName;

    /** @var string */
    private $routeSlugParameterName;

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
