<?php

namespace App\Workflow\Application\UseCase\DTO\Project;

class ProjectDTOTransformer
{
    public function toArray(array $projects): array
    {
        $projectDTO = [];

        foreach ($projects as $project) {
            $projectDTO[] = ['id' => $project->getId(), 'name' => $project->getName(), 'description' => $project->getDescription()];
        }

        return $projectDTO;
    }
}