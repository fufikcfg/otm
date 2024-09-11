<?php

namespace App\Workflow\Infrastructure\Schema;

use App\Shared\Infrastructure\Field\Str;
use App\Shared\Infrastructure\Schema\SchemaAbstract;

class TaskPrioritySchema extends SchemaAbstract
{
    public function type(): string
    {
        return 'task_priorities';
    }

    public function fields(): array
    {
        return [
            Str::make('name'),
            Str::make('color'),
        ];
    }
}