<?php

namespace App\Roles\Application\UseCase\Query\GetRoles;

use App\Roles\Application\UseCase\DTO\RoleDTOTransformer;
use App\Roles\Domain\Repository\RoleRepositoryInterface;
use App\Roles\Domain\Security\RoleFetcherInterface;
use App\Shared\Application\Query\QueryInterface;

readonly class GetRolesHandler implements QueryInterface
{
    public function __construct(
        private RoleRepositoryInterface $userRepository,
        private RoleFetcherInterface $roleFetcher,
        private RoleDTOTransformer $transformer
    ) {
    }

    public function handle(): array
    {
        return $this->transformer->toArray(
            $this->roleFetcher->checkingCompatibility(
                $this->userRepository->all()
            )
        );
    }
}