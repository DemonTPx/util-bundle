<?php

namespace Demontpx\UtilBundle\Test;

/**
 * @copyright 2018 Bert Hekman
 */
trait RethrowControllerExceptionTrait
{
    public function rethrowControllerException()
    {
        $container = static::$kernel->getContainer();

        if ( ! $container->has(ThrowableCollector::class)) {
            throw new \LogicException('Throwable collector service could not be found. Did you set demontpx_util.testing to true in your configuration?');
        }

        $exceptionCollector = $container->get(ThrowableCollector::class);

        $throwable = $exceptionCollector->getThrowable();

        if ($throwable) {
            throw $throwable;
        }
    }
}
