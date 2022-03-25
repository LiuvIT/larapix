<?php

namespace Liuv\Larapix\Services;

use GuzzleHttp\Client;
use Liuv\Larapix\Contracts\Features\WebhooksContract;
use Liuv\Larapix\ValueObjects\Webhook;

class WebhooksService extends BaseService implements WebhooksContract
{
    const BASE_API = 'https://api.openpix.com.br/api/openpix/v1';
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function create(Webhook $webhook): array
    {
        $uri = self::BASE_API . '/webhook';
        $response = $this->client->post($uri, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'body' => json_encode($webhook)
        ]);
        // TODO: decide how to differentiate any type of error

        return $this->success($response->getBody());
    }

    public function findAll(array $parameters = []): array
    {
        $uri = self::BASE_API . '/webhook';

        $response = $this->client->get($uri);

        return $this->success($response->getBody());
    }

    public function delete(string $webhookId): array
    {
        $uri = sprintf(self::BASE_API . '/webhook/%s', $webhookId);
        $response = $this->client->delete($uri);

        return $this->success($response->getBody());
    }
}
