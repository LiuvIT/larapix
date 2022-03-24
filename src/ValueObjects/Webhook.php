<?php

namespace Liuv\Larapix\ValueObjects;

use JetBrains\PhpStorm\Internal\TentativeType;
use JsonSerializable;
use PharIo\Manifest\InvalidUrlException;

class Webhook implements JsonSerializable
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $url;
    /**
     * @var bool
     */
    private $isActive;
    /**
     * @var string
     */
    private $authorization;

    public function __construct(string $name, string $url, bool $isActive, string $authorization = 'openpix')
    {
        $this->name = $name;
        $this->url = $this->transformUrl($url);
        $this->isActive = $isActive;
        $this->authorization = $authorization;
        // TODO: implementar campo 'event' assim que o Sibelius liberar
        // TODO: por padrão, vem o evento de OPENPIX:TRANSACTION_RECEIVED
    }


    public function jsonSerialize(): array
    {
        return [
            'webhook' => [
                'name' => $this->name,
                'url' => $this->url,
                'authorization' => $this->authorization,
                'isActive' => $this->isActive,
            ]
        ];
    }

    private function transformUrl(string $url): string
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidUrlException('A URL digitada é invalida.');
        }

        return $url;
    }
}
