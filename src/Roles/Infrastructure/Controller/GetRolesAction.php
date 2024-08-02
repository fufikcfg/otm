<?php

namespace App\Roles\Infrastructure\Controller;

use App\Roles\Application\UseCase\Query\GetRoles\GetRolesHandler;
use App\Roles\Infrastructure\Responder\V1\RoleResponder;
use App\Roles\Infrastructure\Schema\RoleSchema;
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
        return new RoleResponder($this->getRolesHandler->handle(), RoleSchema::class);
    }
}