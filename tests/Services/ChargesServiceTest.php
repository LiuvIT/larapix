<?php

namespace Liuv\Tests\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Liuv\Larapix\Charges\Charge;
use Liuv\Larapix\Charges\Contracts\ChargeContract;
use Liuv\Larapix\Charges\Services\ChargeService;
use PHPUnit\Framework\TestCase;

class ChargesServiceTest extends TestCase
{
    private $service;

    public function setUp()
    {
        parent::setUp();
    }

    public function test_charges_contract()
    {
        $this->assertInstanceOf(ChargeContract::class, new ChargeService(new Client()));
    }

    public function test_fetch_charge_by_id()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedFetchObject()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $id = 'artur-me-da-um-aumento';
        $this->service = new ChargeService($client);

        // Act
        $actual = $this->service->findById($id);

        // Assert
        $this->assertEquals($this->expectedFetchObject(), $actual);
    }

    public function test_fetch_charges()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedFetchObjects()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $parameters = [];
        $this->service = new ChargeService($client);

        // Act
        $actual = $this->service->findAll($parameters);

        // Assert
        $this->assertEquals($this->expectedFetchObjects(), $actual);
    }

    public function test_charge_creation()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedCreatedChargeObject()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $this->service = new ChargeService($client);
        $charge = new Charge('artur-me-da-um-aumento', 500000);
        // Act
        $actual = $this->service->create($charge);

        // Assert
        $this->assertEquals($this->expectedCreatedChargeObject(), $actual);
    }

    public function expectedFetchObject(): array
    {
        return [
            "charge" => [
                "status" => "ACTIVE",
                "customer" => [
                    "name" => "Dan",
                    "email" => "email0@entria.com.br",
                    "phone" => "119912345670",
                    "taxID" => [
                        "taxID" => "31324227036",
                        "type" => "BR:CPF"
                    ]
                ],
                "value" => 100,
                "comment" => "good",
                "correlationID" => "9134e286-6f71-427a-bf00-241681624586",
                "paymentLinkID" => "7777-6f71-427a-bf00-241681624586",
                "paymentLinkUrl" => "https://openpix.com.br/pay/9134e286-6f71-427a-bf00-241681624586",
                "globalID" => "Q2hhcmdlOjcxOTFmMWIwMjA0NmJmNWY1M2RjZmEwYg==",
                "qrCodeImage" => "https://api.openpix.dev/openpix/charge/brcode/image/9134e286-6f71-427a-bf00-241681624586.png",
                "brCode" => "000201010212261060014br.gov.bcb.pix2584http://localhost:5001/openpix/testing?transactionID=867ba5173c734202ac659721306b38c952040000530398654040.015802BR5909LOCALHOST6009Sao Paulo62360532867ba5173c734202ac659721306b38c963044BCA",
                "additionalInfo" => [
                    [
                        "key" => "Product",
                        "value" => "Pencil"
                    ],
                    [
                        "key" => "Invoice",
                        "value" => "18476"
                    ],
                    [
                        "key" => "Order",
                        "value" => "302"
                    ]
                ],
                "createdAt" => "2021-03-02T17:28:51.882Z",
                "updatedAt" => "2021-03-02T17:28:51.882Z"
            ]
        ];
    }

    public function expectedFetchObjects(): array
    {
        return [
            "pageInfo" => [
                "skip" => 0,
                "limit" => 10,
                "totalCount" => 20,
                "hasPreviousPage" => false,
                "hasNextPage" => true
            ],
            "charges" => [
                "status" => "ACTIVE",
                "customer" => [
                    "name" => "Dan",
                    "email" => "email0@entria.com.br",
                    "phone" => "119912345670",
                    "taxID" => [
                        "taxID" => "31324227036",
                        "type" => "BR:CPF"
                    ]
                ],
                "value" => 100,
                "comment" => "good",
                "correlationID" => "9134e286-6f71-427a-bf00-241681624586",
                "paymentLinkID" => "7777a23s-6f71-427a-bf00-241681624586",
                "paymentLinkUrl" => "https://openpix.com.br/pay/9134e286-6f71-427a-bf00-241681624586",
                "qrCodeImage" => "https://api.openpix.dev/openpix/charge/brcode/image/9134e286-6f71-427a-bf00-241681624586.png",
                "brCode" => "000201010212261060014br.gov.bcb.pix2584http://localhost:5001/openpix/testing?transactionID=867ba5173c734202ac659721306b38c952040000530398654040.015802BR5909LOCALHOST6009Sao Paulo62360532867ba5173c734202ac659721306b38c963044BCA",
                "additionalInfo" => [
                    [
                        "key" => "Product",
                        "value" => "Pencil"
                    ],
                    [
                        "key" => "Invoice",
                        "value" => "18476"
                    ],
                    [
                        "key" => "Order",
                        "value" => "302"
                    ]
                ],
                "createdAt" => "2021-03-02T17:28:51.882Z",
                "updatedAt" => "2021-03-02T17:28:51.882Z"
            ]
        ];
    }

    public function expectedCreatedChargeObject(): array
    {
        return [
            "correlationID" => "artur-me-da-um-aumento",
            "value" => 500000,
            "comment" => "good",
            "customer" => [
                "name" => "Dan",
                "taxID" => "31324227036",
                "email" => "email0@entria.com.br",
                "phone" => "119912345670"
            ],
            "additionalInfo" => [
                [
                    "key" => "Product",
                    "value" => "Pencil"
                ],
                [
                    "key" => "Invoice",
                    "value" => "18476"
                ],
                [
                    "key" => "Order",
                    "value" => "302"
                ]
            ]
        ];
    }
}