<?php

namespace Liuv\Larapix\Core;

use GuzzleHttp\Client;
use Liuv\Larapix\Charges\Contracts\ChargeContract;
use Liuv\Larapix\Charges\Services\ChargeService;
use Liuv\Larapix\Customers\Contracts\CustomerContract;
use Liuv\Larapix\Customers\Services\CustomerService;
use Liuv\Larapix\Payments\Contracts\PaymentsContract;
use Liuv\Larapix\Payments\Services\PaymentsService;
use Liuv\Larapix\Refunds\Contracts\RefundsContract;
use Liuv\Larapix\Refunds\Services\RefundsService;
use Liuv\Larapix\Transaction\Contracts\TransactionContract;
use Liuv\Larapix\Transaction\Services\TransactionsService;
use Liuv\Larapix\Webhooks\Contracts\WebhooksContract;
use Liuv\Larapix\Webhooks\Services\WebhooksService;

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

    public function charges(): ChargeContract
    {
        return new ChargeService($this->client);
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

    public function customers(): CustomerContract
    {
        return new CustomerService($this->client);
    }
}
