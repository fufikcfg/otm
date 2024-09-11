<?php

namespace App\Workflow\Domain\Entity;

class TaskStatus
{
    readonly int $id;

    public function __construct(
        private readonly string $name,
        private readonly string $color
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getId(): int
    {
        return $this->id;
    }
}