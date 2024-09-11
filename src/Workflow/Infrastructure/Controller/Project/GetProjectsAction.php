<?php

namespace App\Workflow\Infrastructure\Controller\Project;

use App\Workflow\Application\UseCase\Query\Project\GetProjects\GetProjectsHandler;
use App\Workflow\Infrastructure\Responder\V1\ProjectResponder;
use App\Workflow\Infrastructure\Schema\ProjectSchema;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/projects/', methods: ['GET'])]
class GetProjectsAction
{
    public function __construct(
        readonly private GetProjectsHandler $getProjectsHandler
    ) {
    }

    public function __invoke(): ProjectResponder
    {
        return new ProjectResponder($this->getProjectsHandler->handle(), ProjectSchema::class);
    }
}
