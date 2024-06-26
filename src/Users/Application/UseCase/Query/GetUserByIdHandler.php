<?php

namespace App\Users\Application\UseCase\Query;

use App\Shared\Application\Query\QueryInterface;
use App\Users\Application\DTO\UserDTO;
use App\Users\Infrastructure\Repository\UserRepository;

class GetUserByIdHandler implements QueryInterface
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function handle(GetUserByIdQuery $query)
    {
        $user = $this->userRepository->findById($query->getUserId());

        if (!$user) {
            throw new \Exception('User not found');
        }

        return new UserDTO(
            id: $user->getId(),
            middleName: $user->getMiddleName(),
            familyName: $user->getFamilyName(),
            username: $user->getUsername(),
            email: $user->getEmail(),
            createdAt: $user->getCreatedAt(),
            updatedAt: $user->getUpdatedAt(),
        );
    }
}