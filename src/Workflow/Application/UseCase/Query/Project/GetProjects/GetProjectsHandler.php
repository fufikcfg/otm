<?php

namespace App\Workflow\Application\UseCase\Query\Project\GetProjects;

use App\Shared\Application\Query\QueryInterface;
use App\Workflow\Application\UseCase\DTO\Project\ProjectDTOTransformer;
use App\Workflow\Infrastructure\Repository\ProjectRepository;

readonly class GetProjectsHandler implements QueryInterface
{
    public function __construct(
        private ProjectRepository $projectRepository,
        private ProjectDTOTransformer $transformer
    ) {
    }

    public function handle(): array
    {
        return $this->transformer->toArray(
            $this->projectRepository->all()
        );
    }
}