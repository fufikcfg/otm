<?php

namespace App\Users\Domain\Service;

use App\Users\Domain\Entity\User;

interface UserPasswordHashedInterface
{
    public function hash(User $user, string $password): string;
}