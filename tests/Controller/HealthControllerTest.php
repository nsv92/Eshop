<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Controller\Health\HealthController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(HealthController::class)]
class HealthControllerTest extends WebTestCase
{
    protected KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    #[Group('all')]
    #[Group('controller')]
    public function test_health(): void
    {
        $this->client->request(method: Request::METHOD_GET, uri: '/eshop/health');
        $content = json_decode($this->client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);
        self::assertResponseStatusCodeSame(Response::HTTP_OK);
        self::assertResponseFormatSame('json');
        self::assertArrayHasKey('health', $content);
    }
}
