<?php

namespace Liuv\Larapix\ValueObjects;

class Charge implements \JsonSerializable
{
    /**
     * @var array
     */
    private $additionalInfo;
    /**
     * @var string|null
     */
    private $expiresIn;
    /**
     * @var string|null
     */
    private $comment;
    /**
     * @var array
     */
    private $customer;
    /**
     * @var int
     */
    private $value;
    /**
     * @var string
     */
    private $corretionId;
    /**
     * @var string|null
     */
    private $identifier;

    public function __construct(
        string $correlationId,
        int $value,
        Customer $customer = null,
        string $comment = '',
        string $identifier = '',
        int $expiresIn = 900,
        array $additionalInfo = []
    ) {
        $this->corretionId = $correlationId;
        $this->value = $value;
        $this->customer = $customer ?? new Customer();
        $this->comment = $comment;
        $this->identifier = $identifier;
        $this->expiresIn = $expiresIn;
        $this->additionalInfo = $additionalInfo;
    }


    public function jsonSerialize(): array
    {
        return [
            'correlationID' => $this->corretionId,
            'value' => $this->value,
            'comment' => $this->comment,
            'identifier' => $this->identifier,
            'expiresIn' => $this->expiresIn,
            'customer' => $this->customer,
            'additionalInfo' => $this->additionalInfo
        ];
    }
}
