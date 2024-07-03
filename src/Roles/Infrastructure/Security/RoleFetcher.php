<?php

namespace App\Roles\Infrastructure\Security;

use App\Roles\Domain\Entity\Role;
use App\Roles\Infrastructure\Service\RoleEnumGetter;
use App\Roles\Domain\Security\RoleFetcherInterface;

readonly class RoleFetcher implements RoleFetcherInterface
{
    public function __construct(
        private RoleEnumGetter $roleEnumGetter
    ) {
    }

    public function checkingCompatibility(array $roles): array
    {
        $currentRoles = $this->roleEnumGetter->getValues();

        foreach ($roles as $role) {
            if ($role instanceof Role) {
                $key = $role->getKey();
                $name = $role->getName();

                if (!isset($currentRoles[$key]) || $currentRoles[$key] !== $name) {
                    throw new \InvalidArgumentException(
                        sprintf(
                            'Role %s does not compatibility or %s !== %s.',
                            $currentRoles[$key], $currentRoles[$key], $name
                        )
                    );
                }
            } else {
                throw new \InvalidArgumentException(
                    sprintf('Role %s does not exist.', $role)
                );
            }
        }

        return $roles;
    }
}