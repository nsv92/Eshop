<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

class UserAlreadyExistException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('User already exists');
    }
}
