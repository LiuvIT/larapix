<?php

namespace Liuv\Larapix\Transaction\Services;

use GuzzleHttp\Client;
use Liuv\Larapix\Core\Services\BaseService;
use Liuv\Larapix\Transaction\Contracts\TransactionContract;

class TransactionsService extends BaseService implements TransactionContract
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

        return $this->success($response->getBody());
    }

    public function findAll(array $parameters = []): array
    {
        $uri = self::BASE_API . '/refund';

        $response = $this->client->get($uri);

        return $this->success($response->getBody());
    }
}
