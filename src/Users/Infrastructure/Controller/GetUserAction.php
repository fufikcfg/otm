<?php

namespace App\Users\Infrastructure\Controller;

use App\Users\Application\UseCase\Query\GetUserById\GetUserByIdHandler;
use App\Users\Application\UseCase\Query\GetUserById\GetUserByIdQuery;
use App\Users\Infrastructure\Responder\V1\UserResponder;
use Exception;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/users/{id}', methods: ['GET'])]
class GetUserAction
{
    public function __construct(
        readonly private GetUserByIdHandler $getUserByIdHandler
    ) {
    }

    /**
     * @throws Exception
     */
    public function __invoke(int $id): UserResponder
    {
        $query = new GetUserByIdQuery($id);
        $userDTO = $this->getUserByIdHandler->handle($query);

        return new UserResponder($userDTO->getId(), [
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
