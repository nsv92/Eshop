<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\SignUpSuccessResponseDto;
use App\Dto\SignUpRequestDto;
use App\Entity\User;
use App\Exception\UserAlreadyExistException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SignUpService
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher,
        private readonly UserRepository               $userRepository,
        private readonly EntityManagerInterface       $em,
        private readonly LoggerInterface              $logger
    )
    {
    }

    public function signUp(SignUpRequestDto $request): SignUpSuccessResponseDto
    {
        if ($this->userRepository->existsByEmail($request->getEmail())) {
            $this->logger->notice(sprintf('User with email %s already exists', $request->getEmail()));
            throw new UserAlreadyExistException();
        }

        $user = (new User())
            ->setEmail($request->getEmail())
            ->setName($request->getName())
            ->setPhone($request->getPhone());

        $user->setPassword($this->hasher->hashPassword($user, $request->getPassword()));

        $this->em->persist($user);
        $this->em->flush();

        return new SignUpSuccessResponseDto($user->getId());
    }
}
