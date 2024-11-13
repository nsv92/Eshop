<?php

declare(strict_types=1);

namespace App\EventSubscriber\Exception;

use App\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationExceptionFormatter extends ExceptionFormatter
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof ValidationException) {
            $this->logger->error('Invalid request', ['exception' => $exception]);

            $errors = $this->toArray($exception->violations);

            $event->setResponse(new JsonResponse(['errors' => $errors], $exception->getCode()));
        }
    }

    /**
     * @return array<string, mixed>
     */
    private function toArray(ConstraintViolationListInterface $violations): array
    {
        $errors = [];

        foreach ($violations as $violation) {
            $errors[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return $errors;
    }
}
