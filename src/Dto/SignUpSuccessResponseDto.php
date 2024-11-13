<?php

declare(strict_types=1);

namespace App\Dto;

readonly class SignUpSuccessResponseDto
{
    public function __construct(
        private string $token,
        private string $refresh_token,
    ) {
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getRefresh_token(): string
    {
        return $this->refresh_token;
    }
}
