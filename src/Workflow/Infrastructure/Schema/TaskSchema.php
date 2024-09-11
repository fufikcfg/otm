<?php

namespace App\Workflow\Infrastructure\Schema;

use App\Shared\Infrastructure\Field\DateTime;
use App\Shared\Infrastructure\Field\Relation;
use App\Shared\Infrastructure\Field\Str;
use App\Shared\Infrastructure\Schema\SchemaAbstract;

class TaskSchema extends SchemaAbstract
{
    public function type(): string
    {
        return 'tasks';
    }

    public function fields(): array
    {
        return [
            Str::make('title'),
            Relation::make('status')->schema(TaskStatusSchema::class),
            Relation::make('priority')->schema(TaskPrioritySchema::class),
            DateTime::make('dueDate'),
            DateTime::make('createdAt'),
            DateTime::make('updatedAt'),
        ];
    }
}