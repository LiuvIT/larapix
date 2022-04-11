<?php

namespace Liuv\Larapix\Payments\Services;

use GuzzleHttp\Client;
use Liuv\Larapix\Core\Services\BaseService;
use Liuv\Larapix\Payments\Contracts\PaymentsContract;
use Liuv\Larapix\Payments\Pix;
use Liuv\Larapix\Payments\QrCode;

class PaymentsService extends BaseService implements PaymentsContract
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

        return $this->success($response->getBody());
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

        return $this->success($response->getBody());
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

        return $this->success($response->getBody());
    }
}
