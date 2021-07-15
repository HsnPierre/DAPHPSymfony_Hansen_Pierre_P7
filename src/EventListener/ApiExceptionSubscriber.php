<?php

namespace App\EventListener;

use Error;
use App\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Normalizer\NotFoundHttpExceptionNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

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

        if(!($e instanceof HttpKernel)){
            $result['code'] = 500;
            $result['body'] = [
                'code' => 500,
                'message' => $e->getRawMessage()
            ];

            $body = $this->serializer->serialize($result['body'], 'json');

            $event->setResponse(new Response($body, $result['code']));
        }
        if($e instanceof HttpExceptionInterface){
            $result['code'] = $e->getStatusCode();
            $result['body'] = [
                'code' => $e->getStatusCode(),
                'message' => $e->getMessage()
            ];

            $body = $this->serializer->serialize($result['body'], 'json');

            $event->setResponse(new Response($body, $result['code']));
        }        
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException'
        ];
    }
}