<?php

namespace App\Users\Domain\Repository;

use App\Users\Domain\Entity\User;

interface UserProjectRepositoryInterface
{
    public function findByUserId(int $id);
}