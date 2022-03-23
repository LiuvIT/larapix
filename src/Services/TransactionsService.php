<?php

namespace Liuv\Larapix\Services;

use GuzzleHttp\Client;
use Liuv\Larapix\Contracts\Features\TransactionContract;

class TransactionsService implements TransactionContract
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

    public function findById(string $transactionId): array
    {
        $uri = sprintf(
            self::BASE_API . '/transaction/%s',
            $transactionId
        );
        $response = $this->client->get($uri);

        return json_decode($response->getBody(), true);
    }

    public function findAll(array $parameters = []): array
    {
        $uri = self::BASE_API . '/refund';

        $response = $this->client->get($uri);

        return json_decode($response->getBody(), true);
    }
}
