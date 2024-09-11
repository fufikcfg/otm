<?php

namespace App\Workflow\Infrastructure\Repository;

use App\Workflow\Domain\Entity\Task;
use App\Workflow\Domain\Repository\TaskRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class TaskRepository extends ServiceEntityRepository implements TaskRepositoryInterface
{
    readonly EntityManagerInterface $_em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
        $this->_em = $this->getEntityManager();
    }

    public function findByProjectId(int $id): array
    {
        return $this->findBy(['project' => $id]);
    }
}