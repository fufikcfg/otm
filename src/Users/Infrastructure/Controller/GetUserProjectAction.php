<?php

namespace App\Users\Infrastructure\Controller;

use App\Users\Application\UseCase\Query\GetUserProjectById\GetUserProjectByIdHandler;
use App\Users\Application\UseCase\Query\GetUserProjectById\GetUserProjectByIdQuery;
use App\Users\Infrastructure\Responder\V1\UserProjectResponder;
use App\Users\Infrastructure\Schema\UserProjectSchema;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/users/{id}/projects', methods: ['GET'])]
class GetUserProjectAction
{
    public function __construct(
        readonly private GetUserProjectByIdHandler $getUserProjectByIdHandler,
    ) {
    }

    public function __invoke(int $id): UserProjectResponder
    {
        return new UserProjectResponder($this->getUserProjectByIdHandler->handle(new GetUserProjectByIdQuery($id)), UserProjectSchema::class);
    }
}
