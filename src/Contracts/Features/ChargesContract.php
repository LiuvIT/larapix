<?php

namespace Liuv\Larapix\Contracts\Features;

use Liuv\Larapix\ValueObjects\Charge;

interface ChargesContract
{
    public function findById(string $id): array;

    public function findAll(array $params = []): array;

    public function create(Charge $charge): array;
}
