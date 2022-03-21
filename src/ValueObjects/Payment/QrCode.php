<?php

namespace Liuv\Larapix\ValueObjects\Payment;


use JsonSerializable;

class QrCode implements JsonSerializable
{
    public function __construct(string $correlationId, string $qrCode, int $value)
    {
        $this->correlationId = $correlationId;
        $this->qrCode = $qrCode;
        $this->value = $value;
    }

    private $correlationId;
    private $qrCode;
    private $value;

    public function jsonSerialize(): array
    {
        return [
            'correlationID' => $this->correlationId,
            'qrcode' => $this->qrCode,
            'value' => $this->value,
        ];
    }
}