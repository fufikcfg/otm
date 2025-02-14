<?php

namespace App\Users\Infrastructure\Schema;

use App\Shared\Infrastructure\Field\DateTime;
use App\Shared\Infrastructure\Field\Str;
use App\Shared\Infrastructure\Schema\SchemaAbstract;

class UserSchema extends SchemaAbstract
{

    public function type(): string
    {
        return 'users';
    }

    public function fields(): array
    {
        return [
            Str::make('middleName'),
            Str::make('givenName'),
            Str::make('familyName'),
            Str::make('username'),
            Str::make('email'),
            DateTime::make('createdAt'),
            DateTime::make('updatedAt'),
        ];
    }
}