<?php

namespace App\Infrastructure\Profiler;

use App\Infrastructure\JsonResponse;
use DateTimeImmutable;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

#[
    AsEventListener(event: 'kernel.request', method: 'onKernelRequest'),
    AsEventListener(event: 'kernel.response', method: 'onKernelResponse')
]
readonly class ResourceProfileListener
{
    public function __construct(
        private ResourceContainer $resourceContainer,
    ) {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $this->resourceContainer
            ->setTime((microtime(true)))
            ->setMemory(memory_get_usage() / 1024 * 8)
        ;
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        if (! $response instanceof JsonResponse) {
            return;
        }

        $executionTime = (microtime(true) - $this->resourceContainer->getTime()) * 1000; // ms
        $usedMemory = (memory_get_usage() - $this->resourceContainer->getMemory()) / 1024 * 8; // kb килобиты

        $response->headers->add([
            'X-Debug-Time' => sprintf('%fms', $executionTime),
            'X-Debug-Memory' => sprintf('%dkb', $usedMemory),
        ]);
    }
}