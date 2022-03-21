<?php

namespace Liuv\Tests\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

use Liuv\Larapix\Contracts\Features\RefundsContract;
use Liuv\Larapix\Services\RefundsService;
use Liuv\Larapix\ValueObjects\Charge;
use PHPUnit\Framework\TestCase;

class RefundServiceTest extends TestCase
{

    public function test_charges_contract()
    {
        $this->assertInstanceOf(RefundsContract::class, new RefundsService(new Client()));
    }

    public function test_fetch_refund()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedFetchObject()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $id = 'artur-me-da-um-aumento';
        $this->service = new RefundsService($client);

        // Act
        $actual = $this->service->findById($id);

        // Assert
        $this->assertTrue(method_exists($this->service, 'findById'));
        $this->assertEquals($this->expectedFetchObject(), $actual);
    }

    public function test_fetch_refunds()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedFetchObjects()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $this->service = new RefundsService($client);
        $parameters = [];
        
        // Act
        $actual = $this->service->findAll($parameters);

        // Assert
        $this->assertTrue(method_exists($this->service, 'findAll'));
        $this->assertEquals($this->expectedFetchObjects(), $actual);
    }

    public function test_create_refund()
    {
        // Prepare
        $mock = new MockHandler([new Response(200, [], json_encode($this->expectedRefundObject()))]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $this->service = new RefundsService($client);
        $parameters = [];
        
        // Act
        $actual = $this->service->findAll($parameters);

        // Assert
        $this->assertTrue(method_exists($this->service, 'create'));
        $this->assertEquals($this->expectedRefundObject(), $actual);
    }

    public function expectedFetchObject()
    {
        return  [
            "refund" => [
                "value" => 100,
                "correlationID" => "7777-6f71-427a-bf00-241681624586",
                "refundId" => "11bf5b37e0b842e08dcfdc8c4aefc000",
                "returnIdentification" => "D09089356202108032000a543e325902"
            ]
        ];
    }
    public function expectedRefundObject()
    {
        return  [
            "refund" => [
                "value" => 100,
                "correlationID" => "7777-6f71-427a-bf00-241681624586",
                "refundId" => "11bf5b37e0b842e08dcfdc8c4aefc000",
                "returnIdentification" => "D09089356202108032000a543e325902"
            ]
        ];
    }

    public function expectedFetchObjects()
    {
        return [
            "pageInfo" => [
                "skip" => 0,
                "limit" => 10,
                "totalCount" => 20,
                "hasPreviousPage" => false,
                "hasNextPage" => true
            ],
            "refunds" => [
                "status" => "IN_PROCESSING",
                "value" => 100,
                "correlationID" => "9134e286-6f71-427a-bf00-241681624586",
                "refundId" => "9134e2866f71427abf00241681624586",
                "time" => "2021-03-02T17:28:51.882Z"
            ]
        ];
    }
}
