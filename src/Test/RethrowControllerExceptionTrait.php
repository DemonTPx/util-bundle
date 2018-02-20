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

        if ( ! $container->has('pbweb_demontpx.throwable_collector')) {
            throw new \LogicException('Throwable collector service could not be found. Did you set demontpx_util.testing to true in your configuration?');
        }

        $exceptionCollector = $container->get('pbweb_demontpx.throwable_collector');

        $throwable = $exceptionCollector->getThrowable();

        if ($throwable) {
            throw $throwable;
        }
    }
}
