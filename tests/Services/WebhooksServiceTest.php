<?php

namespace Liuv\Tests\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Liuv\Larapix\Webhooks\Services\WebhooksService;
use Liuv\Larapix\Webhooks\Webhook;
use PHPUnit\Framework\TestCase;

class WebhooksServiceTest extends TestCase
{
    public function test_webhook_creation()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedCreatedWebhookObject()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $service = new WebhooksService($client);
        $webhookPayload = new Webhook(
            'some-awesome-webhook',
            'https://danielheart.dev',
            true
        );

        // Act
        $actual = $service->create($webhookPayload);

        // Assert
        $this->assertEquals($this->expectedCreatedWebhookObject(), $actual);
    }

    public function test_fetch_transactions()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedPaginatedWebhookObjects()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $parameters = [];
        $service = new WebhooksService($client);

        // Act
        $actual = $service->findAll($parameters);

        // Assert
        $this->assertTrue(method_exists($service, 'findAll'));
        $this->assertEquals($this->expectedPaginatedWebhookObjects(), $actual);
    }

    public function test_delete_webhook()
    {
        // Prepare
        $expected = ['status' => 'string'];
        $mock = new MockHandler([new Response(200, [], json_encode($expected))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $webhookId = 'awesome-webhook-id';
        $service = new WebhooksService($client);

        // Act
        $actual = $service->delete($webhookId);

        // Assert
        $this->assertTrue(method_exists($service, 'delete'));
        $this->assertEquals($expected, $actual);
    }

    private function expectedCreatedWebhookObject(): array
    {
        return [
            "webhook" => [
                "id" => "V2ViaG9vazo2MDNlYmUxZWRlYjkzNWU4NmQyMmNmMTg=",
                "name" => "webhookName",
                "url" => "https://mycompany.com.br/webhook",
                "authorization" => "openpix",
                "isActive" => true,
                "createdAt" => "2021-03-02T22:29:10.720Z",
                "updatedAt" => "2021-03-02T22:29:10.720Z"
            ]
        ];
    }

    private function expectedPaginatedWebhookObjects(): array
    {
        return [
            "pageInfo" => [
                "skip" => 0,
                "limit" => 100,
                "totalCount" => 2,
                "hasPreviousPage" => false,
                "hasNextPage" => true
            ],
            "webhooks" => [
                [
                    "id" => "V2ViaG9vazo2MDNlYmUxZWRlYjkzNWU4NmQyMmNmMTg=",
                    "name" => "webhookName",
                    "url" => "https://mycompany.com.br/webhook",
                    "authorization" => "openpix",
                    "isActive" => true,
                    "createdAt" => "2021-03-02T22:29:10.720Z",
                    "updatedAt" => "2021-03-02T22:29:10.720Z"
                ],
                [
                    "id" => "V2ViaG9vazo2MDNlYmUxZWRlYjkzNWU4NmQyMmNmOTk=",
                    "name" => "webhookName",
                    "url" => "https://mycompany.com.br/webhook",
                    "authorization" => "openpix",
                    "isActive" => true,
                    "createdAt" => "2021-03-02T22:29:10.720Z",
                    "updatedAt" => "2021-03-02T22:29:10.720Z"
                ]
            ]
        ];
    }
}