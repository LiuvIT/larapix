<?php

namespace Liuv\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Liuv\Larapix\Contracts\Features\ChargesContract;
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
}