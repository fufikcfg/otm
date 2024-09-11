<?php

namespace App\Workflow\Infrastructure\Schema;

use App\Shared\Infrastructure\Field\Str;
use App\Shared\Infrastructure\Schema\SchemaAbstract;

class TaskStatusSchema extends SchemaAbstract
{
    public function type(): string
    {
        return 'task_statuses';
    }

    public function fields(): array
    {
        return [
            Str::make('name'),
            Str::make('color'),
        ];
    }
}