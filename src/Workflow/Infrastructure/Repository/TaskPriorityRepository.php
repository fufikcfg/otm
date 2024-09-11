<?php

namespace App\Workflow\Infrastructure\Repository;

use App\Workflow\Domain\Entity\TaskPriority;
use App\Workflow\Domain\Repository\TaskPriorityRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class TaskPriorityRepository extends ServiceEntityRepository implements TaskPriorityRepositoryInterface
{
    readonly EntityManagerInterface $_em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskPriority::class);
        $this->_em = $this->getEntityManager();
    }

    public function all(): array
    {
        return $this->findAll();
    }

    public function create(TaskPriority $taskPriority): ?TaskPriority
    {
        $this->_em->persist($taskPriority);
        $this->_em->flush();

        return $taskPriority;
    }
}