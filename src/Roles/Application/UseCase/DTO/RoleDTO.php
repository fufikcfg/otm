<?php

namespace App\Roles\Application\UseCase\DTO;

readonly class RoleDTO
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
}