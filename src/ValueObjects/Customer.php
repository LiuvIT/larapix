<?php

namespace Liuv\Larapix\ValueObjects;

class Customer implements \JsonSerializable
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $phone;
    /**
     * @var string
     */
    private $taxId;

    public function __construct(string $name = '', string $email = '', string $phone = '', string $taxId = '')
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->taxId = $taxId;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'taxId' => $this->taxId
        ];
    }
}
