<?php

namespace App\Workflow\Application\UseCase\Query\TaskStatus\CreateTaskStatus;

use App\Shared\Application\Query\Query;

readonly class CreateTaskStatusQuery extends Query
{
    public function __construct(
        public string $name,
        public string $color,
    ) {
    }
}