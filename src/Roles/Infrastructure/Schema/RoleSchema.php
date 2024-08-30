<?php

namespace App\Roles\Infrastructure\Schema;

use App\Shared\Infrastructure\Field\Str;
use App\Shared\Infrastructure\Schema\SchemaAbstract;

class RoleSchema extends SchemaAbstract
{
    public function type(): string
    {
        return 'roles';
    }

    public function fields(): array
    {
        return [
            Str::make('name'),
        ];
    }
}