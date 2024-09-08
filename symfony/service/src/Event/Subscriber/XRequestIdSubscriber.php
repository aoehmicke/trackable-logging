<?php

namespace App\Event\Subscriber;

use App\Service\IdGeneratorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class XRequestIdSubscriber implements EventSubscriberInterface
{
    private const X_REQUEST_ID = 'X-Request-ID';

    public function __construct(
        private IdGeneratorInterface $idGenerator,
    )
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest'],
            KernelEvents::RESPONSE => ['onKernelResponse'],
        ];
    }

    public function onKernelRequest(RequestEvent $requestEvent): void
    {
        $request = $requestEvent->getRequest();
        if (!$request->headers->has(self::X_REQUEST_ID)) {
            $request->headers->set(self::X_REQUEST_ID, $this->idGenerator->generate());
        }
    }

    public function onKernelResponse(ResponseEvent $responseEvent): void
    {
        $response = $responseEvent->getResponse();
        $request = $responseEvent->getRequest();

        if ($response->headers->has(self::X_REQUEST_ID)) {
            return;
        }

        if ($request->headers->has(self::X_REQUEST_ID)) {
            $response->headers->set(self::X_REQUEST_ID, $request->headers->get(self::X_REQUEST_ID));
            return;
        }

        $response->headers->set(self::X_REQUEST_ID, $this->idGenerator->generate());
    }
}