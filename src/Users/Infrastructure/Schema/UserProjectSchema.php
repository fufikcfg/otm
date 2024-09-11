<?php

namespace App\Users\Infrastructure\Schema;

use App\Shared\Infrastructure\Field\DateTime;
use App\Shared\Infrastructure\Field\Str;
use App\Shared\Infrastructure\Schema\SchemaAbstract;

class UserProjectSchema extends SchemaAbstract
{
    public function type(): string
    {
        return 'user_projects';
    }

    public function fields(): array
    {
        return [
            Str::make('name'),
            Str::make('description'),
            DateTime::make('createdAt'),
            DateTime::make('updatedAt')
        ];
    }
}