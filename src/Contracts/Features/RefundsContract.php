<?php

namespace Liuv\Larapix\Contracts\Features;

use Liuv\Larapix\ValueObjects\Refund;

interface RefundsContract
{
    public function findById(string $refundId): array;

    public function findAll(array $parameters = []): array;

    public function create(Refund $refund): array;
}
