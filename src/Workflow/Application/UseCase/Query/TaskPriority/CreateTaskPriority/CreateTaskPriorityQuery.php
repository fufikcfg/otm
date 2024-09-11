<?php

namespace App\Workflow\Application\UseCase\Query\TaskPriority\CreateTaskPriority;

use App\Shared\Application\Query\Query;

readonly class CreateTaskPriorityQuery extends Query
{
    public function __construct(
        public string $name,
        public string $color,
    ) {
    }
}