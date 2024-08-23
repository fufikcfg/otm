<?php

namespace App\Users\Infrastructure\Schema;

use App\Roles\Infrastructure\Schema\RoleSchema;
use App\Shared\Infrastructure\Field\DateTime;
use App\Shared\Infrastructure\Field\Relation;
use App\Shared\Infrastructure\Schema\SchemaAbstract;

class UserRoleSchema extends SchemaAbstract
{
    public function type(): string
    {
        return 'user_roles';
    }

    public function fields(array $data): array
    {
        return [
            Relation::makeWith('role', RoleSchema::class),
            Relation::makeWith('user', UserSchema::class),
            DateTime::make('createdAt'),
            DateTime::make('updatedAt'),
        ];
    }
}