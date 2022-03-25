<?php

namespace Liuv\Larapix\Contracts\Features;

use Liuv\Larapix\ValueObjects\Customer;

interface CustomersContract
{
    public function findById(string $id): array;

    public function findAll(array $params = []): array;

    public function create(Customer $customer): array;
}
