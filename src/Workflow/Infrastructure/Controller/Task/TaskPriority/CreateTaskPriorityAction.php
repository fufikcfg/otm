<?php

namespace App\Workflow\Infrastructure\Controller\Task\TaskPriority;

use App\Workflow\Application\UseCase\Query\TaskPriority\CreateTaskPriority\CreateTaskPriorityHandler;
use App\Workflow\Application\UseCase\Query\TaskPriority\CreateTaskPriority\CreateTaskPriorityQuery;
use App\Workflow\Infrastructure\Responder\V1\TaskPriorityResponder;
use App\Workflow\Infrastructure\Schema\TaskPrioritySchema;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/task_priorities', methods: ['POST'])]
class CreateTaskPriorityAction
{
    public function __construct(
        readonly private CreateTaskPriorityHandler $createTaskPriorityHandler
    ) {
    }

    public function __invoke(Request $request): TaskPriorityResponder
    {
        $data = json_decode($request->getContent(), true);

        return new TaskPriorityResponder($this->createTaskPriorityHandler->handle(new CreateTaskPriorityQuery(
           $data['name'],
           $data['color']
        )), TaskPrioritySchema::class);
    }
}
