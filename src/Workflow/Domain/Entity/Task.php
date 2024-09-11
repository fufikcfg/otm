<?php

namespace App\Workflow\Domain\Entity;

class Task
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $key
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getId(): int
    {
        return $this->id;
    }
}