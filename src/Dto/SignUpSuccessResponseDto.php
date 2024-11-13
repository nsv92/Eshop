<?php

declare(strict_types=1);

namespace App\Dto;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Sing up response',
    description: 'JWT и рефреш токены нового пользователя',
)]
class SignUpSuccessResponseDto
{
    #[OA\Property(property: 'token', title: 'JWT', type: 'string')]
    private string $token;

    #[OA\Property(property: 'refresh_token', title: 'Рефреш токен', type: 'string')]
    private string $refresh_token;

    public function __construct(
        string $token,
        string $refresh_token,
    ) {
        $this->refresh_token = $refresh_token;
        $this->token = $token;
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
