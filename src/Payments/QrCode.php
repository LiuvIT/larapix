<?php

namespace Liuv\Larapix\Payments;

use JsonSerializable;

class QrCode implements JsonSerializable
{
    private $correlationId;
    private $qrCode;
    private $value;

    public function __construct(string $correlationId, string $qrCode, int $value)
    {
        $this->correlationId = $correlationId;
        $this->qrCode = $qrCode;
        $this->value = $value;
    }

    public function jsonSerialize(): array
    {
        return [
            'correlationID' => $this->correlationId,
            'qrcode' => $this->qrCode,
            'value' => $this->value,
        ];
    }
}
