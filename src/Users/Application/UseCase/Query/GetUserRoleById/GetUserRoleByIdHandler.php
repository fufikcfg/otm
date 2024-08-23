<?php

namespace App\Users\Application\UseCase\Query\GetUserRoleById;

use App\Roles\Application\UseCase\DTO\RoleDTO;
use App\Shared\Application\Query\QueryInterface;
use App\Users\Application\DTO\UserDTO;
use App\Users\Application\DTO\UserRoleDTO;
use App\Users\Infrastructure\Repository\UserRoleRepository;

readonly class GetUserRoleByIdHandler implements QueryInterface
{
    public function __construct(
        private UserRoleRepository $userRoleRepository,
    ) {
    }

    public function handle(GetUserRoleByIdQuery $query): array
    {
        $user = $this->userRoleRepository->findByUserId($query->getUserId())
            ?? throw new \LogicException('User not found');

        return (new UserRoleDTO(
            $user->getId(),
            (new UserDTO(
                $user->getUser()->getId(),
                $user->getUser()->getMiddleName(),
                $user->getUser()->getGivenName(),
                $user->getUser()->getFamilyName(),
                $user->getUser()->getUsername(),
                $user->getUser()->getEmail(),
                $user->getUser()->getCreatedAt(),
                $user->getUser()->getUpdatedAt(),
            )),
            (new RoleDTO(
                $user->getRole()->getId(),
                $user->getRole()->getName(),
                $user->getRole()->getKey(),
            )),
            $user->getCreatedAt(),
            $user->getUpdatedAt(),
        ))->toArray();
    }
}