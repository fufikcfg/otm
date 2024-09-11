<?php

namespace App\Workflow\Application\UseCase\Query\TaskPriority\CreateTaskPriority;

use App\Shared\Application\Query\QueryInterface;
use App\Workflow\Application\UseCase\DTO\TaskPriority\TaskPriorityDTO;
use App\Workflow\Domain\Factory\TaskPriorityFactory;
use App\Workflow\Infrastructure\Repository\TaskPriorityRepository;

readonly class CreateTaskPriorityHandler implements QueryInterface
{
    public function __construct(
        private TaskPriorityRepository $taskPriorityRepository,
        private TaskPriorityFactory    $priorityFactory
    ) {
    }

    public function handle(CreateTaskPriorityQuery $query): array
    {
        $taskPriority = $this->priorityFactory->create(
            $query->name,
            $query->color,
        );

        $this->taskPriorityRepository->create($taskPriority);

        return (new TaskPriorityDTO(
            $taskPriority->getId(),
            $taskPriority->getName(),
            $taskPriority->getColor(),
        ))->toArray();
    }
}