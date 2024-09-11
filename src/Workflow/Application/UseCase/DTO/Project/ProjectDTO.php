<?php

namespace App\Workflow\Application\UseCase\DTO\Project;

use App\Shared\Application\DTO\ArrayableInterface;

readonly class ProjectDTO implements ArrayableInterface
{
    public function __construct(
        private int $id,
        private string $name,
        private string $description,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

}