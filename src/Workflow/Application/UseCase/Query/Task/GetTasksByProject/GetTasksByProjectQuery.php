<?php

namespace App\Workflow\Application\UseCase\Query\Task\GetTasksByProject;

use App\Shared\Application\Query\Query;

readonly class GetTasksByProjectQuery extends Query
{
    public function __construct(
        private int $projectId
    ) {
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }
}