<?php

namespace App\Users\Infrastructure\Schema;

use App\Shared\Infrastructure\Field\DateTime;
use App\Shared\Infrastructure\Field\Str;
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

            DateTime::make('createdAt'),
            DateTime::make('updatedAt'),
        ];
    }
}