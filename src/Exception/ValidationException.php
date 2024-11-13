<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends \LogicException
{
    public function __construct(
        public readonly ConstraintViolationListInterface $violations,
        string $message = '',
        int $code = Response::HTTP_UNPROCESSABLE_ENTITY,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}
