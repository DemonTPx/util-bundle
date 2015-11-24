<?php

namespace Demontpx\UtilBundle\Slug;

/**
 * Class SluggableManager
 *
 * @author    Bert Hekman <demontpx@gmail.com>
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
     *
     * @return SluggableConfiguration
     */
    public function getConfiguration($class)
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
