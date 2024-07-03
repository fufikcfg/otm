<?php

namespace App\Roles\Infrastructure\Service;

use App\Roles\Domain\Enum\RoleEnum;
use App\Shared\Domain\Service\Enum\EnumGetterAbstract;

class RoleEnumGetter extends EnumGetterAbstract
{
    public function enum(): string
    {
        return RoleEnum::class;
    }
}