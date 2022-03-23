<?php

namespace Liuv\Larapix\Contracts\Features;

interface TransactionContract
{
    public function findById(string $transactionId): array;

    public function findAll(array $parameters = []): array;
}
