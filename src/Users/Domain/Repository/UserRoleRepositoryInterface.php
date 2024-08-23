<?php

namespace App\Users\Domain\Repository;

use App\Users\Domain\Entity\User;

interface UserRoleRepositoryInterface
{
    public function findByUserId(int $id);
//    public function create(User $user): ?User;
}