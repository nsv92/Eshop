<?php

declare(strict_types=1);

namespace App\Dto;

class SignUpSuccessResponseDto
{
    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
