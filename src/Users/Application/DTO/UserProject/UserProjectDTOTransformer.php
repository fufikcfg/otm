<?php

namespace App\Users\Application\DTO\UserProject;

class UserProjectDTOTransformer
{
    public function toArray(array $data): array
    {
        $projects = [];

        foreach ($data as $role) {
            $projects[] = ['id' => $role->getId(), 'name' => $role->getName(), 'description' => $role->getDescription()];
        }

        return $projects;
    }
}