<?php

namespace App\Users\Application\DTO;

readonly class UserDTO
{
    public function __construct(
        private int $id,
        private string $middleName,
        private string $familyName,
        private string $username,
        private string $email,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    public function getFamilyName(): string
    {
        return $this->familyName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}