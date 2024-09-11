<?php

namespace App\Workflow\Infrastructure\Controller\Task\TaskStatus;

use App\Workflow\Application\UseCase\Query\TaskStatus\CreateTaskStatus\CreateTaskStatusHandler;
use App\Workflow\Application\UseCase\Query\TaskStatus\CreateTaskStatus\CreateTaskStatusQuery;
use App\Workflow\Infrastructure\Responder\V1\TaskStatusResponder;
use App\Workflow\Infrastructure\Schema\TaskStatusSchema;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/task_statuses', methods: ['POST'])]
class CreateTaskStatusAction
{
    public function __construct(
        readonly private CreateTaskStatusHandler $createTaskStatusHandler
    ) {
    }

    public function __invoke(Request $request): TaskStatusResponder
    {
        $data = json_decode($request->getContent(), true);

        return new TaskStatusResponder($this->createTaskStatusHandler->handle(new CreateTaskStatusQuery(
            $data['name'],
            $data['color']
        )), TaskStatusSchema::class);
    }
}
