<?php

namespace App\Workflow\Application\UseCase\DTO\TaskPriority;

readonly class TaskPriorityDTO
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