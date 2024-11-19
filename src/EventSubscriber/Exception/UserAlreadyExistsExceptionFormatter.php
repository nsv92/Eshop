<?php

declare(strict_types=1);

namespace App\EventSubscriber\Exception;

use App\Exception\UserAlreadyExistException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class UserAlreadyExistsExceptionFormatter extends ExceptionFormatter
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof UserAlreadyExistException) {
            $this->logger->error('Invalid request', ['exception' => $exception]);

            $event->setResponse(new JsonResponse(['message' => $exception->getMessage()], $exception->getCode()));
        }
    }
}
