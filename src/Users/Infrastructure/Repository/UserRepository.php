<?php

namespace App\Users\Infrastructure\Repository;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    private object $_em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
        $this->_em = $this->getEntityManager();
    }

    public function findById(int $id): ?User
    {
        return $this->find($id);
    }

    public function create(User $user): ?User
    {
        $this->_em->persist($user);
        $this->_em->flush();

        return $user;
    }
}