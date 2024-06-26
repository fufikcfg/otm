<?php

namespace App\Users\Infrastructure\Controller;

use App\Users\Application\UseCase\Query\GetUserByIdHandler;
use App\Users\Application\UseCase\Query\GetUserByIdQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/users/{id}', methods: ['GET'])]
class GetUserAction
{
    public function __construct(
        private GetUserByIdHandler $getUserByIdHandler
    ) {
    }

    public function __invoke(int $id): JsonResponse
    {
        try {
            $query = new GetUserByIdQuery($id);
            $userDTO = $this->getUserByIdHandler->handle($query);

            return new JsonResponse([
                $userDTO->getId(),
                $userDTO->getMiddleName(),
                $userDTO->getFamilyName(),
                $userDTO->getUsername(),
                $userDTO->getEmail(),
                $userDTO->getCreatedAt(),
                $userDTO->getUpdatedAt(),
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
