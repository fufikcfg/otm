<?php

namespace App\Workflow\Domain\Factory;

use App\Workflow\Domain\Entity\TaskPriority;

class TaskPriorityFactory
{
    public function create(string $name, string $color): TaskPriority
    {
        return new TaskPriority(
            $name,
            $color,
        );
    }
}