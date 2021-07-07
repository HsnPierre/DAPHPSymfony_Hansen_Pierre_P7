<?php

namespace App\EventListener;

use App\Normalizer\NormalizerInterface;
use App\Normalizer\NotFoundHttpExceptionNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiExceptionSubscriber implements EventSubscriberInterface
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $e = $event->getThrowable();

        $result['code'] = $e->getStatusCode();
        $result['body'] = [
            'code' => $e->getStatusCode(),
            'message' => $e->getMessage()
        ];

        $body = $this->serializer->serialize($result['body'], 'json');

        $event->setResponse(new Response($body, $result['code']));
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException'
        ];
    }
}