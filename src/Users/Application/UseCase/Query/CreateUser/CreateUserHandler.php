<?php

namespace App\Users\Application\UseCase\Query\CreateUser;

use App\Shared\Application\Query\QueryInterface;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Infrastructure\Repository\UserRepository;

readonly class CreateUserHandler implements QueryInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private UserFactory $userFactory
    ) {
    }

    public function handle(CreateUserQuery $query): User
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

        return $user;
    }
}