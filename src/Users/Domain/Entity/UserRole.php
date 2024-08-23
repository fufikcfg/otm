<?php

namespace App\Users\Domain\Entity;

use App\Roles\Domain\Entity\Role;

class UserRole
{
    readonly int $id;

    public function __construct(
        private readonly User $user,
        private Role $role,
        private readonly \DateTime $createdAt,
        private \DateTime          $updatedAt
    ) {
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): void
    {
        $this->role = $role;
    }
}