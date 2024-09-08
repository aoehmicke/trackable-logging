<?php

namespace App\Tests\Controller;

use App\Tests\__helper\RegularExpressionHelper;
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class WriteLogEntryTest extends ApiTestCase
{
    public function setUp(): void
    {
        self::bootKernel();
    }

    public function testEmptyPostAction()
    {
        $emptyRequestBody = json_encode([]);

        static::createClient()->request(
            method: 'POST',
            url: '/api/logs',
            options: [
                'headers' => [
                    'Accept' => 'application/ld+json',
                    'Content-Type' => 'application/ld+json',
                ],
                'body' => $emptyRequestBody
            ],
        );

        $this->assertResponseStatusCodeSame(442);
        $this->assertResponseHasHeader('X-Request-ID');
    }

    public function testPostActionWithXRequestID() {
        $emptyRequestBody = json_encode([]);
        $expectedXRequestID = 'my-test-id';

        static::createClient()->request(
            method: 'POST',
            url: '/api/logs',
            options: [
                'headers' => [
                    'Accept' => 'application/ld+json',
                    'Content-Type' => 'application/ld+json',
                    'X-Request-ID' => $expectedXRequestID
                ],
                'body' => $emptyRequestBody
            ],
        );

        $this->assertResponseHeaderSame('X-Request-ID', $expectedXRequestID);
    }
}