<?php

namespace Liuv\Larapix\Customers\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Liuv\Larapix\Core\Services\BaseService;
use Liuv\Larapix\Customers\Contracts\CustomerContract;
use Liuv\Larapix\Customers\Customer;
use Liuv\Larapix\Customers\Exceptions\CustomerNotFoundException;

class CustomerService extends BaseService implements CustomerContract
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

    public function findById(string $id): array
    {
        $uri = sprintf(self::BASE_API . '/customer/%s', $id);
        try {
            $response = $this->client->get($uri);
        } catch (ClientException $exception) {
            throw new CustomerNotFoundException(
                json_encode(['error' => 'Customer not found']),
                404
            );
        }

        return $this->success($response->getBody());
    }

    public function findAll(array $params = []): array
    {
        $uri = self::BASE_API . '/customer';
        $response = $this->client->get($uri);

        return $this->success($response->getBody());
    }

    public function create(Customer $customer): array
    {
        $uri = self::BASE_API . '/customer';

        $response = $this->client->post($uri, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'body' => json_encode($customer)
        ]);

        return $this->success($response->getBody());
    }
}
