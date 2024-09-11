<?php

namespace App\Roles\Application\UseCase\DTO;

class RoleDTOTransformer
{
    public function toArray(array $data): array
    {
        $rolesDTO = [];

        foreach ($data as $role) {
            $rolesDTO[] = ['id' => $role->getId(), 'name' => $role->getName(), 'key' => $role->getKey()];
        }

        return $rolesDTO;
    }
}