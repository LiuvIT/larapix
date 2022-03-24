<?php

namespace Liuv\Larapix\Contracts\Features;

use Liuv\Larapix\ValueObjects\Webhook;

interface WebhooksContract
{
    public function create(Webhook $webhook): array;

    public function findAll(array $parameters = []): array;

    public function delete(string $webhookId): array;
}
