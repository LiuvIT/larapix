<?php

namespace Liuv\Larapix\Services;

use GuzzleHttp\Client;
use Liuv\Larapix\Contracts\Features\PaymentsContract;
use Liuv\Larapix\ValueObjects\Payment\Pix;
use Liuv\Larapix\ValueObjects\Payment\QrCode;

class PaymentsService implements PaymentsContract
{
    const BASE_API = 'https://api.openpix.com.br/api/openpix/v1/pay';
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function initPixPayment(Pix $pix): array
    {
        $uri = self::BASE_API . '/pix-key';
        $response = $this->client->post($uri, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'body' => json_encode($pix)
        ]);
        // TODO: decide how to differentiate any type of error

        return json_decode($response->getBody(), true);
    }

    public function initQrCodePayment(QrCode $qrCode): array
    {
        $uri = self::BASE_API . '/qrcode';
        $response = $this->client->post($uri, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'body' => json_encode($qrCode)
        ]);
        // TODO: decide how to differentiate any type of error

        return json_decode($response->getBody(), true);
    }

    public function confirmPayment(string $paymentCorrelationId): array
    {
        $uri = self::BASE_API . '/confirm';
        $response = $this->client->post($uri, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'body' => json_encode([
                'correlationID' => $paymentCorrelationId
            ])
        ]);
        // TODO: decide how to differentiate any type of error

        return json_decode($response->getBody(), true);
    }
}
