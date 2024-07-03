<?php

namespace App\Roles\Application\UseCase\DTO;

use App\Roles\Domain\Entity\Role;

class RoleDTOTransformer
{
    public function transformArrayToDTO(array $data): array
    {
        $rolesDTO = [];

        foreach ($data as $role) {
            if ($role instanceof Role) {
                $rolesDTO[] = new RoleDTO($role->id, $role->name, $role->key);
            }
        }

        return $rolesDTO;
    }
}