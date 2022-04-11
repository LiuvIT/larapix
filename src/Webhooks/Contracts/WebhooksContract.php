<?php

namespace Liuv\Larapix\Webhooks\Contracts;

use Liuv\Larapix\Webhooks\Webhook;

interface WebhooksContract
{
    public function create(Webhook $webhook): array;

    public function findAll(array $parameters = []): array;

    public function delete(string $webhookId): array;
}
