<?php

namespace App\Workflow\Infrastructure\Repository;

use App\Workflow\Domain\Entity\Project;
use App\Workflow\Domain\Repository\ProjectRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class ProjectRepository extends ServiceEntityRepository implements ProjectRepositoryInterface
{
    readonly EntityManagerInterface $_em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
        $this->_em = $this->getEntityManager();
    }

    public function all(): array
    {
        return $this->findAll();
    }
}