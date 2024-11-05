<?php

declare(strict_types=1);

namespace App\Controller\Health;

use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HealthController extends AbstractController
{
    #[OA\Get(
        summary: 'Проверка доступности сервиса',
        responses: [new OA\Response(ref: '#/components/responses/health_ok', response: 200)]
    )]
    #[OA\Tag(name: 'Service health check')]
    #[Route('/health', name: 'check_health', methods: 'GET')]
    public function checkHealth(): JsonResponse
    {
        return $this->json(['health' => 'OK']);
    }
}
