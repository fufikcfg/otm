<?php

namespace App\Workflow\Application\UseCase\Query\TaskStatus\GetTeskStatuses;

use App\Shared\Application\Query\QueryInterface;
use App\Workflow\Application\UseCase\DTO\TaskStatus\TaskStatusDTOTransformer;
use App\Workflow\Infrastructure\Repository\TaskStatusRepository;

readonly class GetTaskStatusesHandler implements QueryInterface
{
    public function __construct(
        private TaskStatusRepository $taskStatusRepository,
        private TaskStatusDTOTransformer $transformer
    ) {
    }

    public function handle(): array
    {
        return $this->transformer->toArray(
            $this->taskStatusRepository->all()
        );
    }
}