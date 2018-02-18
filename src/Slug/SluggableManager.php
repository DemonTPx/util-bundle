<?php

namespace Demontpx\UtilBundle\Slug;

/**
 * @copyright 2015 Bert Hekman
 */
class SluggableManager
{
    /** @var SluggableConfiguration */
    private $configurationList = [];

    public function register(SluggableConfiguration $configuration)
    {
        $this->configurationList[$configuration->getClassName()] = $configuration;
    }

    /**
     * @param string|SluggableInterface $class
     */
    public function getConfiguration($class): SluggableConfiguration
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        if ( ! is_a($class, SluggableInterface::class, true)) {
            throw new \InvalidArgumentException(sprintf('Class %s should implement %s', $class, SluggableInterface::class));
        }

        return $this->configurationList[$class];
    }
}
