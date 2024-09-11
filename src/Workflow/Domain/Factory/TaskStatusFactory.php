<?php

namespace App\Workflow\Domain\Factory;

use App\Workflow\Domain\Entity\TaskStatus;

class TaskStatusFactory
{
    public function create(string $name, string $color): TaskStatus
    {
        return new TaskStatus(
            $name,
            $color,
        );
    }
}