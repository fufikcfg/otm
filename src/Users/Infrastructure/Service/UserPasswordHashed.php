<?php

namespace App\Users\Infrastructure\Service;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Service\UserPasswordHashedInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class UserPasswordHashed implements UserPasswordHashedInterface
{
    public function __construct(
        private readonly PasswordHasherFactoryInterface $passwordHashedFactory
    ) {
    }

    public function hash(User $user, string $password): string
    {
        $passwordHashed = $this->passwordHashedFactory->getPasswordHasher($user);
        return $passwordHashed->hash($password);
    }
}