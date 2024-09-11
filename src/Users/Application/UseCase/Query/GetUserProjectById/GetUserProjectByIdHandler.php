<?php

namespace App\Users\Application\UseCase\Query\GetUserProjectById;

use App\Shared\Application\Query\QueryInterface;
use App\Users\Application\DTO\UserProject\UserProjectDTOTransformer;
use App\Users\Infrastructure\Repository\UserProjectRepository;

readonly class GetUserProjectByIdHandler implements QueryInterface
{
    public function __construct(
        private UserProjectRepository $userProjectRepository,
        private UserProjectDTOTransformer $transformer
    ) {
    }

    public function handle(GetUserProjectByIdQuery $query): array
    {
        $projects = $this->userProjectRepository->findByUserId($query->getUserId())
            ?? throw new \LogicException('User not found');

        return $this->transformer->toArray(
            $projects->getProjects()->toArray()
        );
    }
}