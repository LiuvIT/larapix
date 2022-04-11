<?php

namespace Liuv\Tests\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Liuv\Larapix\Customers\Customer;
use Liuv\Larapix\Customers\Services\CustomerService;
use PHPUnit\Framework\TestCase;

class CustomersServiceTest extends TestCase
{
    public function test_fetch_customer_by_id()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedFetchObject()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $id = 'nvm';
        $service = new CustomerService($client);

        // Act
        $actual = $service->findById($id);

        // Assert
        $this->assertEquals($this->expectedFetchObject(), $actual);
    }

    public function test_fetch_customers()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedFetchObjects()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $parameters = [];
        $service = new CustomerService($client);

        // Act
        $actual = $service->findAll($parameters);

        // Assert
        $this->assertEquals($this->expectedFetchObjects(), $actual);
    }

    public function test_customer_creation()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedCreatedObject()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $service = new CustomerService($client);
        $charge = new Customer(
            'danielhe4rt',
            'hey@danielheart.dev',
            '119812312312',
            '61465890041'
        );
        // Act
        $actual = $service->create($charge);

        // Assert
        $this->assertEquals($this->expectedCreatedObject(), $actual);
    }

    private function expectedFetchObject(): array
    {
        return [
            "customer" => [
                "name" => "Dan",
                "email" => "email0@entria.com.br",
                "phone" => "119912345670",
                "taxID" => [
                    "taxID" => "31324227036",
                    "type" => "BR:CPF"
                ],
                "correlationID" => "fe7834b4060c488a9b0f89811be5f5cf"
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
            "customers" => [
                "customer" => [
                    "name" => "Dan",
                    "email" => "email0@entria.com.br",
                    "phone" => "119912345670",
                    "taxID" => [
                        "taxID" => "31324227036",
                        "type" => "BR:CPF"
                    ]
                ]
            ]
        ];
    }

    private function expectedCreatedObject(): array
    {
        return [
            "customer" => [
                "name" => "Dan",
                "email" => "email0@entria.com.br",
                "phone" => "119912345670",
                "taxID" => [
                    "taxID" => "31324227036",
                    "type" => "BR:CPF"
                ]
            ]
        ];
    }
}