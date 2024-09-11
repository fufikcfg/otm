<?php

namespace App\Workflow\Infrastructure\Controller\Task\TaskStatus;

use App\Workflow\Application\UseCase\Query\TaskStatus\GetTeskStatuses\GetTaskStatusesHandler;
use App\Workflow\Infrastructure\Responder\V1\TaskStatusResponder;
use App\Workflow\Infrastructure\Schema\TaskStatusSchema;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/task_statuses', methods: ['GET'])]
class GetTaskStatusesAction
{
    public function __construct(
        readonly private GetTaskStatusesHandler $getTaskStatusesHandler
    ) {
    }

    public function __invoke(): TaskStatusResponder
    {
        return new TaskStatusResponder($this->getTaskStatusesHandler->handle(), TaskStatusSchema::class);
    }
}
