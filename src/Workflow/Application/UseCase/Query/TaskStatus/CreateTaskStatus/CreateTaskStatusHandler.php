<?php

namespace App\Workflow\Application\UseCase\Query\TaskStatus\CreateTaskStatus;

use App\Shared\Application\Query\QueryInterface;
use App\Workflow\Application\UseCase\DTO\TaskStatus\TaskStatusDTO;
use App\Workflow\Domain\Factory\TaskStatusFactory;
use App\Workflow\Infrastructure\Repository\TaskStatusRepository;

readonly class CreateTaskStatusHandler implements QueryInterface
{
    public function __construct(
        private TaskStatusRepository $taskStatusRepository,
        private TaskStatusFactory    $statusFactory
    ) {
    }

    public function handle(CreateTaskStatusQuery $query): array
    {
        $taskStatus = $this->statusFactory->create(
            $query->name,
            $query->color,
        );

        $this->taskStatusRepository->create($taskStatus);

        return (new TaskStatusDTO(
            $taskStatus->getId(),
            $taskStatus->getName(),
            $taskStatus->getColor(),
        ))->toArray();
    }
}