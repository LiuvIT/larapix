<?php

namespace Liuv\Larapix\Transaction\Contracts;

interface TransactionContract
{
    public function findById(string $transactionId): array;

    public function findAll(array $parameters = []): array;
}
