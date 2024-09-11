<?php

namespace App\Workflow\Domain\Entity;

class Task
{
    private readonly int $id;

    public function __construct(
        private string             $title,
        private TaskStatus         $status,
        private TaskPriority       $priority,
        private readonly Project   $project,
        private \DateTime          $dueDate,
        private readonly \DateTime $createdAt,
        private \DateTime          $updatedAt
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getStatus(): TaskStatus
    {
        return $this->status;
    }

    public function setStatus(TaskStatus $status): void
    {
        $this->status = $status;
    }

    public function getPriority(): TaskPriority
    {
        return $this->priority;
    }

    public function setPriority(TaskPriority $priority): void
    {
        $this->priority = $priority;
    }

    public function getDueDate(): \DateTime
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate): void
    {
        $this->dueDate = $dueDate;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}