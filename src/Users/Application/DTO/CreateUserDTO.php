<?php

namespace App\Users\Application\DTO;

readonly class CreateUserDTO
{
    public function __construct(
        private int $id,
        private string $middleName,
        private string $givenName,
        private string $familyName,
        private string $username,
        private string $email,
        private string $password,
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

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getGivenName(): string
    {
        return $this->givenName;
    }
}