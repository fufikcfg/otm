<?php

namespace App\Users\Domain\Entity;

use App\Workflow\Domain\Entity\Project;
use Doctrine\Common\Collections\ArrayCollection;

class UserProject
{
    readonly int $id;

    public function __construct(
        private readonly User $user,
        private $projects,
        private readonly \DateTime $createdAt,
        private \DateTime          $updatedAt
    ) {
        $this->projects = new ArrayCollection();
    }

    public function addProject(Project $project): void
    {
        $this->projects[] = $project;
    }

    public function getProjects()
    {
        return $this->projects;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}