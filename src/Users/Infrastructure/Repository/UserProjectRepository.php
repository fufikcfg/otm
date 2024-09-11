<?php

namespace App\Users\Infrastructure\Repository;

use App\Users\Domain\Entity\UserProject;
use App\Users\Domain\Repository\UserProjectRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class UserProjectRepository extends ServiceEntityRepository implements UserProjectRepositoryInterface
{
    private EntityManagerInterface $_em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserProject::class);
        $this->_em = $this->getEntityManager();
    }

    public function findByUserId(int $id): ?UserProject
    {
        return $this->findOneBy(['user' => $id]);
    }
}