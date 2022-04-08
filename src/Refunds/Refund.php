<?php

namespace Liuv\Larapix\Refunds;

class Refund implements \JsonSerializable
{
    private $transactionEndToEndId;

    private $correlationId;

    private $value;

    public function __construct(
        string $correlationId,
        string $transactionEndToEndId,
        int $value
    ) {
        $this->corretionId = $correlationId;
        $this->transactionEndToEndId = $transactionEndToEndId;
        $this->value = $value;
    }


    public function jsonSerialize(): array
    {
        return [
            'correlationID' => $this->corretionId,
            'transactionEndToEndId' => $this->transactionEndToEndId,
            'value' => $this->value,
        ];
    }
}
