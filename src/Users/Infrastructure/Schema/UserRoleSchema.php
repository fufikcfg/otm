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

    public function fields(): array
    {
        return [
            Relation::make('role')->schema(RoleSchema::class),
            Relation::make('user')->schema(UserSchema::class),
            DateTime::make('createdAt'),
            DateTime::make('updatedAt'),
        ];
    }
}