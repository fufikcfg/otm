<?php

namespace App\Roles\Domain\Security;

interface RoleFetcherInterface
{
    public function checkingCompatibility(array $roles): array;
}