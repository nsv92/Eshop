<?php

declare(strict_types=1);

namespace App\Dto;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

#[OA\Schema(
    title: 'Sing up request',
    description: 'Регистрация нового пользователя',
    required: ['email', 'password', 'confirmPassword', 'name', 'phone']
)]
class SignUpRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Email]
    #[OA\Property(property: 'email', title: 'Адрес электронной почты', type: 'string')]
    private string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 8)]
    #[OA\Property(property: 'password', title: 'Пароль', type: 'string')]
    private string $password;

    #[Assert\NotBlank]
    #[Assert\EqualTo(propertyPath: 'password', message: 'Passwords do not match')]
    #[OA\Property(property: 'confirm_password', title: 'Подтверждение пароля', type: 'string')]
    private string $confirmPassword;

    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    #[OA\Property(property: 'name', title: 'Имя пользователя', type: 'string')]
    private string $name;

    #[Assert\NotBlank]
    #[Assert\Length(max: 25)]
    #[OA\Property(property: 'phone', title: 'Телефон', type: 'string')]
    private string $phone;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
