<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Test;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;

/**
 * @copyright 2018 Bert Hekman
 */
class ThrowableCollector
{
    private ?\Throwable $throwable = null;

    public function set(\Throwable $exception)
    {
        $this->throwable = $exception;
    }

    public function getThrowable(): ?\Throwable
    {
        return $this->throwable;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $this->throwable = $event->getThrowable();
    }
}
