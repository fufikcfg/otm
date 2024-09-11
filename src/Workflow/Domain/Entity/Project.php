<?php

namespace App\Workflow\Domain\Entity;

use App\Users\Domain\Entity\User;

class Project
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $description,
        private readonly User $owner,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUser(): User
    {
        return $this->owner;
    }
}