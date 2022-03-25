<?php

namespace Liuv\Larapix;

use GuzzleHttp\Client;
use Liuv\Larapix\Contracts\Features\ChargesContract;
use Liuv\Larapix\Contracts\Features\PaymentsContract;
use Liuv\Larapix\Contracts\Features\RefundsContract;
use Liuv\Larapix\Contracts\Features\TransactionContract;
use Liuv\Larapix\Contracts\Features\WebhooksContract;
use Liuv\Larapix\Contracts\LarapixContract;
use Liuv\Larapix\Services\ChargesService;
use Liuv\Larapix\Services\PaymentsService;
use Liuv\Larapix\Services\RefundsService;
use Liuv\Larapix\Services\TransactionsService;
use Liuv\Larapix\Services\WebhooksService;

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

    public function refunds(): RefundsContract
    {
        return new RefundsService($this->client);
    }

    public function payments(): PaymentsContract
    {
        return new PaymentsService($this->client);
    }

    public function transactions(): TransactionContract
    {
        return new TransactionsService($this->client);
    }

    public function webhooks(): WebhooksContract
    {
        return new WebhooksService($this->client);
    }
}
