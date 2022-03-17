<?php

namespace Liuv\Larapix;

use GuzzleHttp\Client;
use Liuv\Larapix\Contracts\Features\ChargesContract;
use Liuv\Larapix\Contracts\LarapixContract;
use Liuv\Larapix\Services\ChargesService;

class LarapixService implements LarapixContract
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function charges(): ChargesContract
    {
        return new ChargesService($this->client);
    }
}