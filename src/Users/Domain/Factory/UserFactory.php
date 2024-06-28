<?php

namespace App\Users\Domain\Factory;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Service\UserPasswordHashedInterface;

class UserFactory
{
    public function __construct(
        private readonly UserPasswordHashedInterface $passwordHashed,
        private readonly \DateTime $dateTime = new \DateTime()
    ) {
    }

    public function create(string $middleName, string $givenName, string $familyName, string $username, string $email, string $password): User
    {
        return (new User(
            $middleName,
            $givenName,
            $familyName,
            $username,
            $email,
            $password,
            $this->dateTime,
            $this->dateTime,
        ))->setPassword($password, $this->passwordHashed);
    }
}