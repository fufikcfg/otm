<?php

namespace App\Users\Infrastructure\Controller;

use App\Users\Application\UseCase\Query\CreateUser\CreateUserHandler;
use App\Users\Application\UseCase\Query\CreateUser\CreateUserQuery;
use App\Users\Infrastructure\Responder\V1\UserResponder;
use App\Users\Infrastructure\Schema\UserSchema;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/users', methods: ['POST'])]
class CreateUserAction
{
    public function __construct(
        readonly private CreateUserHandler $createUserHandler
    ) {
    }

    public function __invoke(Request $request)
    {
        $request = $request->toArray();
        $query = new CreateUserQuery(
            $request['middleName'],
            $request['givenName'],
            $request['familyName'],
            $request['username'],
            $request['email'],
            $request['password'],
        );
        $userDTO = $this->createUserHandler->handle($query);

        return new UserResponder($userDTO, UserSchema::class);
    }
}
