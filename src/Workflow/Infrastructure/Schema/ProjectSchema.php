<?php

namespace App\Workflow\Infrastructure\Schema;

use App\Shared\Infrastructure\Field\Str;
use App\Shared\Infrastructure\Schema\SchemaAbstract;

class ProjectSchema extends SchemaAbstract
{
    public function type(): string
    {
        return 'projects';
    }

    public function fields(): array
    {
        return [
            Str::make('name'),
            Str::make('description'),
        ];
    }
}