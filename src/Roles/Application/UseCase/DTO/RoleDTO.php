<?php

namespace App\Roles\Application\UseCase\DTO;

use App\Shared\Application\DTO\ArrayableInterface;

readonly class RoleDTO implements ArrayableInterface
{
    public function __construct(
        private int $id,
        private string $name,
        private string $key,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'key' => $this->getKey(),
        ];
    }
}