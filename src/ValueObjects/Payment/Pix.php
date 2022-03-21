<?php

namespace Liuv\Larapix\ValueObjects\Payment;

use JsonSerializable;

class Pix implements JsonSerializable
{
    private $availableKeyTypes = [
        'cpf', 'cnpj', 'email', 'phone', 'random'
    ];
    private $correlationId;
    private $pixKey;
    private $pixKeyType;
    private $value;

    public function __construct(
        string $correlationId,
        string $pixKey,
        string $pixKeyType,
        int    $value
    )
    {
        $this->validateKeyTypes($pixKeyType);
        $this->correlationId = $correlationId;
        $this->pixKey = $pixKey;
        $this->pixKeyType = $pixKeyType;
        $this->value = $value;
    }

    public function jsonSerialize(): array
    {
        return [
            'correlationID' => $this->correlationId,
            'pixKey' => $this->pixKey,
            'pixKeyType' => $this->pixKeyType,
            'value' => $this->value
        ];
    }

    private function validateKeyTypes(string $pixKeyType)
    {
        if (!in_array(strtolower($pixKeyType), $this->availableKeyTypes)) {
            // TODO: Pix type exception???
            throw new \Exception('pensar no que colocar aqui');
        }
    }
}