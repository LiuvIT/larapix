<?php

namespace Liuv\Larapix\Charges\Contracts;

use Liuv\Larapix\Charges\Charge;

interface ChargeContract
{
    public function findById(string $id): array;

    public function findAll(array $params = []): array;

    public function create(Charge $charge): array;
}
