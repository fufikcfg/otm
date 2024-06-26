<?php

namespace App\Users\Domain\Repository;

interface UserRepositoryInterface
{
    public function findById(int $id);
}