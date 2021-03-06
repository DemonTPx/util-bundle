<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Slug;

/**
 * @copyright 2015 Bert Hekman
 */
class SluggableManager
{
    /** @var SluggableConfiguration[] */
    private array $configurationList = [];

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

        if (isset($this->configurationList[$class])) {
            return $this->configurationList[$class];
        }

        foreach (class_parents($class) as $parent) {
            if (isset($this->configurationList[$parent])) {
                return $this->configurationList[$parent];
            }
        }

        throw new \InvalidArgumentException(sprintf('No sluggable configuration found for class %s or its parent(s) ', $class));
    }
}
