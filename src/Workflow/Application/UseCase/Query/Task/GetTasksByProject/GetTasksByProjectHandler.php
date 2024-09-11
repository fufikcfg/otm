<?php

namespace App\Workflow\Application\UseCase\Query\Task\GetTasksByProject;

use App\Shared\Application\Query\QueryInterface;
use App\Workflow\Application\UseCase\DTO\Project\ProjectDTOTransformer;
use App\Workflow\Application\UseCase\DTO\Task\TaskDTOTransformer;
use App\Workflow\Infrastructure\Repository\ProjectRepository;
use App\Workflow\Infrastructure\Repository\TaskRepository;

readonly class GetTasksByProjectHandler implements QueryInterface
{
    public function __construct(
        private TaskRepository $taskRepository,
        private TaskDTOTransformer $transformer
    ) {
    }

    public function handle(GetTasksByProjectQuery $query): array
    {
        return $this->transformer->toArray(
            $this->taskRepository->findByProjectId($query->getProjectId())
        );
    }
}