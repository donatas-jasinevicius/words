<?php

namespace DoJa\Component\FOSRest;

use DoJa\Component\FOSRest\Exception\ApiException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionListener implements EventSubscriberInterface
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!$exception instanceof ApiException) {
            return;
        }
        $responseData = [
            'code' => $exception->getCode(),
            'error_code' => $exception->getErrorCode(),
        ];

        if (strlen($exception->getMessage()) > 0) {
            $responseData['message'] = $exception->getMessage();
        }

        $event->setResponse(new JsonResponse($responseData));
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION => array('onKernelException', -128),
        );
    }
}