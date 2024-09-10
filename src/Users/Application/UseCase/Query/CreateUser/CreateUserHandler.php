<?php

namespace App\Users\Application\UseCase\Query\CreateUser;

use App\Roles\Infrastructure\Repository\RoleRepository;
use App\Shared\Application\Query\QueryInterface;
use App\Users\Application\DTO\UserDTO;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Domain\Factory\UserRoleFactory;
use App\Users\Infrastructure\Repository\UserRepository;
use App\Users\Infrastructure\Repository\UserRoleRepository;

readonly class CreateUserHandler implements QueryInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private RoleRepository $roleRepository,
        private UserRoleRepository $userRoleRepository,
        private UserFactory $userFactory,
        private UserRoleFactory $userRoleFactory
    ) {
    }

    public function handle(CreateUserQuery $query): array
    {
        $user = $this->userFactory->create(
            $query->middleName,
            $query->givenName,
            $query->familyName,
            $query->username,
            $query->email,
            $query->password,
        );

        $this->userRepository->create($user);
        $userRole = $this->userRoleFactory->create(
            $user, $this->roleRepository->getDefaultRole()
        );

        $this->userRoleRepository->initialDefaultRole($userRole);

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