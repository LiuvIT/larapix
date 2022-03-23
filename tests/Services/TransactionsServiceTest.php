<?php

namespace Liuv\Tests\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Liuv\Larapix\Services\RefundsService;
use Liuv\Larapix\Services\TransactionsService;
use PHPUnit\Framework\TestCase;

class TransactionsServiceTest extends TestCase
{
    public function test_fetch_transaction_by_id()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedFetchObject()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $id = 'some-random-id-here';
        $service = new TransactionsService($client);

        // Act
        $actual = $service->findById($id);

        // Assert
        $this->assertTrue(method_exists($service, 'findById'));
        $this->assertEquals($this->expectedFetchObject(), $actual);
    }

    public function test_fetch_transactions()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedFetchObjects()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $parameters = [];
        $service = new TransactionsService($client);

        // Act
        $actual = $service->findAll($parameters);

        // Assert
        $this->assertTrue(method_exists($service, 'findAll'));
        $this->assertEquals($this->expectedFetchObjects(), $actual);
    }

    private function expectedFetchObject(): array
    {
        return [
            "transaction" => [
                "customer" => [
                    "name" => "Dan",
                    "email" => "email0@entria.com.br",
                    "phone" => "119912345670",
                    "taxID" => [
                        "taxID" => "31324227036",
                        "type" => "BR:CPF"
                    ],
                    "correlationID" => "9134e286-6f71-427a-bf00-241681624586"
                ],
                "payer" => [
                    "name" => "Dan",
                    "email" => "email0@entria.com.br",
                    "phone" => "119912345670",
                    "taxID" => [
                        "taxID" => "31324227036",
                        "type" => "BR:CPF"
                    ],
                    "correlationID" => "9134e286-6f71-427a-bf00-241681624586"
                ],
                "charge" => [
                    "status" => "ACTIVE",
                    "customer" => "603f81fcc6bccc24326ffb43",
                    "correlationID" => "9134e286-6f71-427a-bf00-241681624586",
                    "createdAt" => "2021-03-03T12:33:00.546Z",
                    "updatedAt" => "2021-03-03T12:33:00.546Z"
                ],
                "infoPagador" => "payer info 0",
                "value" => 100,
                "time" => "2021-03-03T12:33:00.536Z",
                "transactionID" => "transactionID",
                "endToEndId" => "E18236120202012032010s0133872GZA",
                "globalID" => "UGl4VHJhbnNhY3Rpb246NzE5MWYxYjAyMDQ2YmY1ZjUzZGNmYTBi"
            ]
        ];
    }

    private function expectedFetchObjects(): array
    {
        return [
            "pageInfo" => [
                "skip" => 0,
                "limit" => 10,
                "totalCount" => 20,
                "hasPreviousPage" => false,
                "hasNextPage" => true
            ],
            "transactions" => [
                "customer" => [
                    "name" => "Dan",
                    "email" => "email0@entria.com.br",
                    "phone" => "119912345670",
                    "taxID" => [
                        "taxID" => "31324227036",
                        "type" => "BR:CPF"
                    ],
                    "correlationID" => "9134e286-6f71-427a-bf00-241681624586"
                ],
                "payer" => [
                    "name" => "Dan",
                    "email" => "email0@entria.com.br",
                    "phone" => "119912345670",
                    "taxID" => [
                        "taxID" => "31324227036",
                        "type" => "BR:CPF"
                    ],
                    "correlationID" => "9134e286-6f71-427a-bf00-241681624586"
                ],
                "charge" => [
                    "status" => "ACTIVE",
                    "customer" => "603f81fcc6bccc24326ffb43",
                    "correlationID" => "9134e286-6f71-427a-bf00-241681624586",
                    "createdAt" => "2021-03-03T12:33:00.546Z",
                    "updatedAt" => "2021-03-03T12:33:00.546Z"
                ],
                "infoPagador" => "payer info 0",
                "value" => 100,
                "time" => "2021-03-03T12:33:00.536Z",
                "transactionID" => "transactionID",
                "endToEndId" => "E18236120202012032010s0133872GZA"
            ]
        ];
    }
}
