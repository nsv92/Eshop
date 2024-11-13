<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\SignUpRequestDto;
use App\Dto\SignUpSuccessResponseDto;
use App\Service\SignUpService;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\RequestBody;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AuthController extends AbstractController
{
    public function __construct(
        private readonly SignUpService $signUpService,
        private readonly SerializerInterface $serializer,
    ) {
    }

    #[OA\Post(
        summary: 'New user sign up',
        requestBody: new RequestBody(content: new OA\JsonContent(ref: new Model(type: SignUpRequestDto::class))),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Signs up new user',
                content: new Model(type: SignUpSuccessResponseDto::class)
            ),
            new OA\Response(response: 409, description: 'User already exists'),
            new OA\Response(ref: '#/components/responses/422', response: 422),
            new OA\Response(ref: '#/components/responses/500', response: 500),
        ]
    )]
    #[OA\Tag(name: 'Auth')]
    #[Route(path: '/api/v1/auth/signUp', name: 'sign_up', methods: ['POST'])]
    public function signUp(Request $request): Response
    {
        return $this->signUpService->signUp(
            $this->serializer->deserialize($request->getContent(), SignUpRequestDto::class, 'json')
        );
    }
}
