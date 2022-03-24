<?php

namespace Liuv\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Liuv\Larapix\Contracts\Features\ChargesContract;
use Liuv\Larapix\Contracts\Features\PaymentsContract;
use Liuv\Larapix\Contracts\Features\RefundsContract;
use Liuv\Larapix\Contracts\Features\TransactionContract;
use Liuv\Larapix\Contracts\Features\WebhooksContract;
use Liuv\Larapix\Contracts\LarapixContract;
use Liuv\Larapix\LarapixService;
use PHPUnit\Framework\TestCase;

class LarapixServiceTest extends TestCase
{
    private $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = new LarapixService(new Client());
    }

    public function test_larapix_contract()
    {
        $this->assertInstanceOf(LarapixContract::class, $this->service);
    }

    public function test_larapix_charge_function()
    {
        $this->assertInstanceOf(LarapixContract::class, $this->service);
        $this->assertInstanceOf(ChargesContract::class, $this->service->charges());
    }

    public function test_larapix_refund_function()
    {
        $this->assertInstanceOf(LarapixContract::class, $this->service);
        $this->assertInstanceOf(RefundsContract::class, $this->service->refunds());
    }

    public function test_larapix_payments_function()
    {
        $this->assertInstanceOf(LarapixContract::class, $this->service);
        $this->assertInstanceOf(PaymentsContract::class, $this->service->payments());
    }

    public function test_larapix_transactions_function()
    {
        $this->assertInstanceOf(LarapixContract::class, $this->service);
        $this->assertInstanceOf(TransactionContract::class, $this->service->transactions());
    }

    public function test_larapix_webhooks_function()
    {
        $this->assertInstanceOf(LarapixContract::class, $this->service);
        $this->assertInstanceOf(WebhooksContract::class, $this->service->webhooks());
    }
}
