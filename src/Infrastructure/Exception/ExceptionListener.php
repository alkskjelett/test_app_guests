<?php

namespace App\Infrastructure\Exception;

use App\Infrastructure\JsonResponse;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

#[AsEventListener(event: 'kernel.exception')]
class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $event->setResponse(new JsonResponse(['error' => $exception->getMessage()], $exception->getCode() ?: 400));
    }
}