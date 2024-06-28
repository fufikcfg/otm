<?php

namespace App\Users\Infrastructure\Controller;

use App\Users\Application\UseCase\Query\CreateUser\CreateUserHandler;
use App\Users\Application\UseCase\Query\CreateUser\CreateUserQuery;
use App\Users\Infrastructure\Responder\UserResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        return new UserResponder($userDTO->getId(), [
            'id' => $userDTO->getId(),
            'middleName' => $userDTO->getMiddleName(),
            'familyName' => $userDTO->getFamilyName(),
            'givenName' => $userDTO->getGivenName(),
            'username' => $userDTO->getUsername(),
            'email' => $userDTO->getEmail(),
            'createdAt' => $userDTO->getCreatedAt(),
            'updatedAt' => $userDTO->getUpdatedAt(),
        ]);
    }
}
