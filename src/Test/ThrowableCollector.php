<?php

namespace Demontpx\UtilBundle\Test;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * @copyright 2018 Bert Hekman
 */
class ThrowableCollector
{
    /** @var \Throwable */
    private $throwable = null;

    public function set(\Throwable $exception)
    {
        $this->throwable = $exception;
    }

    public function getThrowable(): ?\Throwable
    {
        return $this->throwable;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $this->throwable = $event->getException();
    }
}
