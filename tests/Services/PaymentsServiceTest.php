<?php

namespace Liuv\Tests\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Liuv\Larapix\Payments\Contracts\PaymentsContract;
use Liuv\Larapix\Payments\Pix;
use Liuv\Larapix\Payments\QrCode;
use Liuv\Larapix\Payments\Services\PaymentsService;
use PHPUnit\Framework\TestCase;

class PaymentsServiceTest extends TestCase
{
    public function test_payments_contract()
    {
        $this->assertInstanceOf(PaymentsContract::class, new PaymentsService(new Client()));
    }

    public function test_payment_with_pix_key()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedPaymentWithPixObject()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $service = new PaymentsService($client);
        $pixPayload = new Pix(
            'artur-ah-deixa-quieto',
            'hey@danielheart.dev',
            'email',
            1000
        );

        // Act
        $actual = $service->initPixPayment($pixPayload);

        // Assert
        $this->assertTrue(method_exists($service, 'initPixPayment'));
        $this->assertEquals($this->expectedPaymentWithPixObject(), $actual);
    }

    public function test_payment_with_qrcode_key()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedPaymentWithQrCodeObject()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $service = new PaymentsService($client);
        $pixPayload = new QrCode(
            'artur-ah-deixa-quieto',
            'qr-code-maluco',
            1000
        );

        // Act
        $actual = $service->initQrCodePayment($pixPayload);

        // Assert
        $this->assertTrue(method_exists($service, 'initQrCodePayment'));
        $this->assertEquals($this->expectedPaymentWithQrCodeObject(), $actual);
    }

    public function test_payment_confirmation()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedPaymentConfirmationObject()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $service = new PaymentsService($client);
        $paymentId = 'desisti-do-aumento-quero-uma-ferrari-de-bonus';

        // Act
        $actual = $service->confirmPayment($paymentId);

        // Assert
        $this->assertTrue(method_exists($service, 'confirmPayment'));
        $this->assertEquals($this->expectedPaymentConfirmationObject(), $actual);
    }

    public function expectedPaymentWithPixObject(): array
    {
        return [
            "payment" => [
                "correlationID" => "9134e286-6f71-427a-bf00-241681624586",
                "destination" => [
                    "value" => 100,
                    "status" => "PENDING",
                    "pixKey" => "c4249323-b4ca-43f2-8139-8232aab09b93",
                    "pixKeyType" => "RANDOM",
                    "account" => [
                        "branch" => "1234",
                        "account" => "12345",
                        "accountType" => "ContaCorrente"
                    ],
                    "psp" => [
                        "id" => "1234",
                        "name" => "Banco de Exemplo",
                        "code" => "555"
                    ],
                    "holder" => [
                        "name" => "Pessoa Juridica",
                        "taxID" => [
                            "taxID" => "1234567890",
                            "type" => "CNPJ"
                        ]
                    ]
                ]
            ]
        ];
    }

    public function expectedPaymentWithQrCodeObject(): array
    {
        return [
            "payment" => [
                "correlationID" => "9134e286-6f71-427a-bf00-241681624586",
                "destination" => [
                    "value" => 100,
                    "status" => "PENDING",
                    "pixKey" => "c4249323-b4ca-43f2-8139-8232aab09b93",
                    "pixKeyType" => "RANDOM",
                    "account" => [
                        "branch" => "1234",
                        "account" => "12345",
                        "accountType" => "ContaCorrente"
                    ],
                    "psp" => [
                        "id" => "1234",
                        "name" => "Banco de Exemplo",
                        "code" => "555"
                    ],
                    "holder" => [
                        "name" => "Pessoa Juridica",
                        "taxID" => [
                            "taxID" => "1234567890",
                            "type" => "CNPJ"
                        ]
                    ]
                ]
            ]
        ];
    }

    public function expectedPaymentConfirmationObject(): array
    {
        return [
            "payment" => [
                "correlationID" => "9134e286-6f71-427a-bf00-241681624586",
                "destination" => [
                    "value" => 100,
                    "status" => "CONFIRMED",
                    "pixKey" => "c4249323-b4ca-43f2-8139-8232aab09b93",
                    "pixKeyType" => "RANDOM",
                    "account" => [
                        "branch" => "1234",
                        "account" => "12345",
                        "accountType" => "ContaCorrente"
                    ],
                    "psp" => [
                        "id" => "1234",
                        "name" => "Banco de Exemplo",
                        "code" => "555"
                    ],
                    "holder" => [
                        "name" => "Pessoa Juridica",
                        "taxID" => [
                            "taxID" => "1234567890",
                            "type" => "CNPJ"
                        ]
                    ]
                ]
            ]
        ];
    }
}
