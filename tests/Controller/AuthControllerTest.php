<?php

declare(strict_types=1);

namespace App\Tests\Controller;


use App\Controller\AuthController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

#[CoversClass(AuthController::class)]
class AuthControllerTest extends WebTestCase
{
    protected KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    #[Group('all')]
    #[Group('controller')]
    public function test_signUp_success(): void
    {
        $body = json_encode([
            'email' => 'valid@mail.com',
            'password' => 'password',
            'confirm_password' => 'password',
            'name' => 'valid name',
            'phone' => '1234567890'
        ]);

        $this->client->request(method: 'POST', uri: '/eshop/api/v1/auth/signUp', content: $body);
        $content = json_decode($this->client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertResponseIsSuccessful();
        $this->assertResponseFormatSame('json');
        $this->assertArrayHasKey('token', $content);
        $this->assertArrayHasKey('refresh_token', $content);
    }

    #[Group('all')]
    #[Group('controller')]
    public function test_signUp_validationError(): void
    {
        $body = json_encode([
            'email' => 'invalid',
            'password' => '132',
            'confirm_password' => '321'
        ]);

        $this->client->request(method: 'POST', uri: '/eshop/api/v1/auth/signUp', content: $body);
        $content = json_decode($this->client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertResponseStatusCodeSame(422);
        $this->assertResponseFormatSame('json');
        $this->assertArrayHasKey('errors', $content);
        $this->assertArrayNotHasKey('token', $content);
        $this->assertArrayNotHasKey('refresh_token', $content);
    }

    #[Group('all')]
    #[Group('controller')]
    public function test_signUp_userAlreadyExists(): void
    {
        $body = json_encode([
            'email' => 'user@eshop.com',
            'password' => 'password',
            'confirm_password' => 'password',
            'name' => 'valid name',
            'phone' => '1234567896'
        ]);
        $this->client->request(method: 'POST', uri: '/eshop/api/v1/auth/signUp', content: $body);
        $content = json_decode($this->client->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertResponseStatusCodeSame(409);
        $this->assertResponseFormatSame('json');
        $this->assertArrayHasKey('message', $content);
        $this->assertArrayNotHasKey('token', $content);
        $this->assertArrayNotHasKey('refresh_token', $content);
    }
}
