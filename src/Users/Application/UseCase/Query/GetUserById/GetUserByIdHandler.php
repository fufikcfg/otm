<?php

namespace App\Users\Application\UseCase\Query\GetUserById;

use App\Shared\Application\Query\QueryInterface;
use App\Users\Application\DTO\UserDTO;
use App\Users\Infrastructure\Repository\UserRepository;

readonly class GetUserByIdHandler implements QueryInterface
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function handle(GetUserByIdQuery $query): UserDTO|\Exception
    {
        $user = $this->userRepository->findById($query->getUserId());

        if (!$user) {
            throw new \Exception('User not found');
        }

        return new UserDTO(
            id: $user->getId(),
            middleName: $user->getMiddleName(),
            givenName: $user->getGivenName(),
            familyName: $user->getFamilyName(),
            username: $user->getUsername(),
            email: $user->getEmail(),
            createdAt: $user->getCreatedAt(),
            updatedAt: $user->getUpdatedAt(),
        );
    }
}