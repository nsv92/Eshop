<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class SignUpRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Email]
    private string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 8)]
    private string $password;

    #[Assert\NotBlank]
    #[Assert\EqualTo(propertyPath: 'password', message: 'Passwords do not match')]
    private string $confirmPassword;

    #[Assert\NotBlank]
    #[Assert\Length(max: 50)]
    private string $name;

    #[Assert\NotBlank]
    #[Assert\Length(max: 25)]
    private string $phone;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): SignUpRequestDto
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): SignUpRequestDto
    {
        $this->password = $password;

        return $this;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): SignUpRequestDto
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): SignUpRequestDto
    {
        $this->name = $name;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): SignUpRequestDto
    {
        $this->phone = $phone;

        return $this;
    }
}
