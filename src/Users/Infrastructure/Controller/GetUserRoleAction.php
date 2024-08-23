<?php

namespace App\Users\Infrastructure\Controller;

use App\Users\Application\UseCase\Query\GetUserRoleById\GetUserRoleByIdHandler;
use App\Users\Application\UseCase\Query\GetUserRoleById\GetUserRoleByIdQuery;
use App\Users\Infrastructure\Responder\V1\UserRoleResponder;
use App\Users\Infrastructure\Schema\UserRoleSchema;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/users/{id}/role', methods: ['GET'])]
class GetUserRoleAction
{
    public function __construct(
        readonly private GetUserRoleByIdHandler $getUserRoleByIdHandler,
    ) {
    }

    public function __invoke(int $id): UserRoleResponder
    {
        return new UserRoleResponder($this->getUserRoleByIdHandler->handle(new GetUserRoleByIdQuery($id)), UserRoleSchema::class);
    }
}
