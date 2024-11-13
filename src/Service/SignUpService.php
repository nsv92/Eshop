<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\SignUpRequestDto;
use App\Entity\User;
use App\Exception\UserAlreadyExistException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class SignUpService
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
        private AuthenticationSuccessHandler $successHandler,
        private UserRepository $userRepository,
        private EntityManagerInterface $em,
        private LoggerInterface $logger,
    ) {
    }

    public function signUp(SignUpRequestDto $request): Response
    {
        if ($this->userRepository->existsByEmail($request->getEmail())) {
            $this->logger->notice(sprintf('User with email %s already exists', $request->getEmail()));
            throw new UserAlreadyExistException();
        }

        $user = (new User())
            ->setRoles(['ROLE_USER'])
            ->setEmail($request->getEmail())
            ->setName($request->getName())
            ->setPhone($request->getPhone());

        $user->setPassword($this->hasher->hashPassword($user, $request->getPassword()));

        $this->em->persist($user);
        $this->em->flush();

        return $this->successHandler->handleAuthenticationSuccess($user);
    }
}
