<?php

namespace App\Workflow\Infrastructure\Repository;

use App\Workflow\Domain\Entity\TaskStatus;
use App\Workflow\Domain\Repository\TaskStatusRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class TaskStatusRepository extends ServiceEntityRepository implements TaskStatusRepositoryInterface
{
    readonly EntityManagerInterface $_em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskStatus::class);
        $this->_em = $this->getEntityManager();
    }

    public function all(): array
    {
        return $this->findAll();
    }

    public function create(TaskStatus $taskStatus): ?TaskStatus
    {
        $this->_em->persist($taskStatus);
        $this->_em->flush();

        return $taskStatus;
    }
}