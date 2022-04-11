<?php

namespace Liuv\Larapix\Refunds\Contracts;

use Liuv\Larapix\Refunds\Refund;

interface RefundsContract
{
    public function findById(string $refundId): array;

    public function findAll(array $parameters = []): array;

    public function create(Refund $refund): array;
}
