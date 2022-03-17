<?php

namespace Liuv\Larapix\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Liuv\Larapix\Contracts\Features\ChargesContract;
use Liuv\Larapix\Exceptions\ChargeAlreadyCreatedException;
use Liuv\Larapix\Exceptions\ChargeNotFoundException;
use Liuv\Larapix\ValueObjects\Charge;

class ChargesService implements ChargesContract
{
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
        $uri = 'https://api.openpix.com.br/api/openpix/v1/charge/' . $id;
        try {
            $response = $this->client->get($uri);
        } catch (ClientException $exception) {
            throw new ChargeNotFoundException(
                json_encode(['error' => 'Charge not found']),
                404
            );
        }

        return json_decode($response->getBody(), true);
    }

    public function findAll(array $params = []): array
    {
        $uri = 'https://api.openpix.com.br/api/openpix/v1/charge/';

        $response = $this->client->get($uri);

        return json_decode($response->getBody(), true);
    }

    public function create(Charge $charge): array
    {
        $uri = 'https://api.openpix.com.br/api/openpix/v1/charge';

        try {
            $response = $this->client->post($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'body' => json_encode($charge)
            ]);
        } catch (ClientException $exception) {
            // TODO: decide how to differentiate any type of error
            throw new ChargeAlreadyCreatedException(
                json_encode(['error' => 'Charge "correlationId" already been used.']),
                422
            );
        }

        return json_decode($response->getBody(), true);
    }

    public function generateQrCode(string $chargeId): string
    {
        $uri = sprintf(
            'https://api.openpix.com.br/openpix/charge/brcode/image/%s.png?size=1024',
            $chargeId
        );
        var_dump($uri);

        $response = $this->client->get($uri);
        return $response->getBody();
    }
}