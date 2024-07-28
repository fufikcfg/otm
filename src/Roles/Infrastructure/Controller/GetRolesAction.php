<?php

namespace App\Roles\Infrastructure\Controller;

use App\Roles\Application\UseCase\Query\GetRoles\GetRolesHandler;
use App\Roles\Infrastructure\Schema\RoleSchema;
use App\Users\Infrastructure\Responder\V1\UserResponder;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/roles', methods: ['GET'])]
class GetRolesAction
{
    public function __construct(
        private GetRolesHandler $getRolesHandler
    ) {
    }

    public function __invoke()
    {
        return new UserResponder($this->getRolesHandler->handle(), RoleSchema::class);
    }
}