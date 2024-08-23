<?php

namespace App\Users\Application\DTO;

use App\Roles\Application\UseCase\DTO\RoleDTO;
use App\Shared\Application\DTO\ArrayableInterface;
use App\Shared\Application\Service\Arrayable\InstanceofChecker;

readonly class UserRoleDTO implements ArrayableInterface
{
    public function __construct(
        private int $id,
        private UserDTO $user,
        private RoleDTO $role,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
        InstanceofChecker::execute($this->getUser(), $this->getRole())
            ?: throw new \InvalidArgumentException(
                "{$this->getUser()} or {$this->getRole()} do not have an Arrayable implementation"
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'user' => $this->getUser()->toArray(),
            'role' => $this->getRole()->toArray(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
        ];
    }

    public function getUser(): UserDTO
    {
        return $this->user;
    }

    public function getRole(): RoleDTO
    {
        return $this->role;
    }
}