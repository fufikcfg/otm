<?php

namespace App\Workflow\Application\UseCase\Query\TaskPriority\GetTaskPriorities;

use App\Shared\Application\Query\QueryInterface;
use App\Workflow\Application\UseCase\DTO\TaskPriority\TaskPriorityDTOTransformer;
use App\Workflow\Infrastructure\Repository\TaskPriorityRepository;

readonly class GetTaskPrioritiesHandler implements QueryInterface
{
    public function __construct(
        private TaskPriorityRepository $taskPriorityRepository,
        private TaskPriorityDTOTransformer $transformer
    ) {
    }

    public function handle(): array
    {
        return $this->transformer->toArray(
            $this->taskPriorityRepository->all()
        );
    }
}