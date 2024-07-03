<?php

namespace App\Roles\Infrastructure\Repository;

use App\Roles\Domain\Entity\Role;
use App\Roles\Domain\Repository\RoleRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RoleRepository extends ServiceEntityRepository implements RoleRepositoryInterface
{
    readonly object $_em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
        $this->_em = $this->getEntityManager();
    }

    public function all(): array
    {
        return $this->findAll();
    }
}