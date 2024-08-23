<?php

namespace App\Users\Application\UseCase\Query\GetUserById;

use App\Shared\Application\Query\QueryInterface;
use App\Users\Application\DTO\UserDTO;
use App\Users\Infrastructure\Repository\UserRepository;

readonly class GetUserByIdHandler implements QueryInterface
{
    public function __construct(
        private UserRepository $userRepository,

    ) {
    }

    public function handle(GetUserByIdQuery $query): array
    {
        $user = $this->userRepository->findById($query->getUserId())
            ?? throw new \LogicException('User not found');

        return (new UserDTO(
            $user->getId(),
            $user->getMiddleName(),
            $user->getGivenName(),
            $user->getFamilyName(),
            $user->getUsername(),
            $user->getEmail(),
            $user->getCreatedAt(),
            $user->getUpdatedAt(),
        ))->toArray();
    }
}