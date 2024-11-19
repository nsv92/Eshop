<?php

declare(strict_types=1);

namespace App\Exception;

class UserAlreadyExistException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct(message: 'User already exists', code: 409);
    }
}
