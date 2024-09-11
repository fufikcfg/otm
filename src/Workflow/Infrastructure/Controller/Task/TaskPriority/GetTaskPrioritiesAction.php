<?php

namespace App\Workflow\Infrastructure\Controller\Task\TaskPriority;

use App\Workflow\Application\UseCase\Query\TaskPriority\GetTaskPriorities\GetTaskPrioritiesHandler;
use App\Workflow\Infrastructure\Responder\V1\TaskPriorityResponder;
use App\Workflow\Infrastructure\Schema\TaskPrioritySchema;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/task_priorities', methods: ['GET'])]
class GetTaskPrioritiesAction
{
    public function __construct(
        readonly private GetTaskPrioritiesHandler $getTaskPrioritiesHandler
    ) {
    }

    public function __invoke(): TaskPriorityResponder
    {
        return new TaskPriorityResponder($this->getTaskPrioritiesHandler->handle(), TaskPrioritySchema::class);
    }
}
