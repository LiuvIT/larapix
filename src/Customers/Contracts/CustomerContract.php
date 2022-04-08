<?php

namespace Liuv\Larapix\Customers\Contracts;

use Liuv\Larapix\Customers\Customer;

interface CustomerContract
{
    public function findById(string $id): array;

    public function findAll(array $params = []): array;

    public function create(Customer $customer): array;
}
