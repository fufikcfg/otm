<?php

namespace App\Users\Infrastructure\Controller;

use App\Users\Application\UseCase\Query\GetUserById\GetUserByIdHandler;
use App\Users\Application\UseCase\Query\GetUserById\GetUserByIdQuery;
use App\Users\Infrastructure\Responder\V1\UserResponder;
use App\Users\Infrastructure\Schema\UserSchema;
use Exception;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/users/{id}', methods: ['GET'])]
class GetUserAction
{
    public function __construct(
        readonly private GetUserByIdHandler $getUserByIdHandler,
    ) {
    }

    /**
     * @throws Exception
     */
    public function __invoke(int $id): UserResponder
    {
        return new UserResponder($this->getUserByIdHandler->handle(new GetUserByIdQuery($id)), UserSchema::class);
    }
}
