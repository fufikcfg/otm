<?php

namespace App\Users\Infrastructure\Repository;

use App\Roles\Domain\Entity\Role;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Entity\UserRole;
use App\Users\Domain\Repository\UserRoleRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class UserRoleRepository extends ServiceEntityRepository implements UserRoleRepositoryInterface
{
    private EntityManagerInterface $_em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserRole::class);
        $this->_em = $this->getEntityManager();
    }

    public function findByUserId(int $id): ?UserRole
    {
        return $this->findOneBy(['user' => $id]);
    }

    public function initialDefaultRole(UserRole $userRole): UserRole
    {
        $this->_em->persist($userRole);
        $this->_em->flush();

        return $userRole;
    }
}