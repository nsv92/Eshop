<?php

declare(strict_types=1);

namespace App\Validator;

use App\Exception\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class Validator
{
    public function __construct(
        private ValidatorInterface $validator,
    ) {
    }

    public function validate(object $object): void
    {
        $violations = $this->validator->validate($object);

        if (count($violations) > 0) {
            throw new ValidationException($violations, 'Validation errors', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
