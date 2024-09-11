<?php

namespace App\Workflow\Application\UseCase\DTO\TaskStatus;

use App\Shared\Application\DTO\ArrayableInterface;

readonly class TaskStatusDTO implements ArrayableInterface
{
    public function __construct(
        private int $id,
        private string $name,
        private string $color,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'color' => $this->getColor()
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getName(): string
    {
        return $this->name;
    }
}