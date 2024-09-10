<?php

namespace App\Users\Domain\Factory;

use App\Roles\Domain\Entity\Role;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Entity\UserRole;

class UserRoleFactory
{
    public function __construct(
        private readonly \DateTime $dateTime = new \DateTime()
    ) {
    }

    public function create(User $user, Role $role): UserRole
    {
        return (new UserRole($user, $role, $this->dateTime, $this->dateTime));
    }
}