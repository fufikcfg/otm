<?php

namespace App\Workflow\Infrastructure\Controller\Task\Task;
use App\Workflow\Application\UseCase\Query\Project\GetProjects\GetProjectsHandler;
use App\Workflow\Application\UseCase\Query\Task\GetTasksByProject\GetTasksByProjectHandler;
use App\Workflow\Application\UseCase\Query\Task\GetTasksByProject\GetTasksByProjectQuery;
use App\Workflow\Infrastructure\Responder\V1\TaskResponder;
use App\Workflow\Infrastructure\Schema\TaskSchema;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/tasks/{id}/project', methods: ['GET'])]
class GetTasksByProjectAction
{
    public function __construct(
        readonly private GetTasksByProjectHandler $getProjectsHandler
    ) {
    }

    public function __invoke(int $id): TaskResponder
    {
        return new TaskResponder($this->getProjectsHandler->handle((new GetTasksByProjectQuery($id))), TaskSchema::class);
    }
}
