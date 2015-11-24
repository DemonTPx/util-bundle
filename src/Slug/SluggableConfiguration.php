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

    /**
     * @param string $className
     * @param string $routeName
     * @param string $routeIdParameterName
     * @param string $routeSlugParameterName
     */
    public function __construct(
        $className,
        $routeName,
        $routeIdParameterName = 'id',
        $routeSlugParameterName = 'slug'
    )
    {
        $this->className = $className;
        $this->routeName = $routeName;
        $this->routeIdParameterName = $routeIdParameterName;
        $this->routeSlugParameterName = $routeSlugParameterName;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * @return string
     */
    public function getRouteIdParameterName()
    {
        return $this->routeIdParameterName;
    }

    /**
     * @return string
     */
    public function getRouteSlugParameterName()
    {
        return $this->routeSlugParameterName;
    }
}
