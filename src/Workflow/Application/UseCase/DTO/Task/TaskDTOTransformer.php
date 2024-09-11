<?php

namespace App\Workflow\Application\UseCase\DTO\Task;

class TaskDTOTransformer
{
    public function toArray(array $data): array
    {
        $tasks = [];

        foreach ($data as $datum) {
            $tasks[] = [
                'id' => $datum->getId(),
                'title' => $datum->getTitle(),
                'dueDate' => $datum->getDueDate(),
                'createdAt' => $datum->getCreatedAt(),
                'updatedAt' => $datum->getUpdatedAt(),
                'status' => [
                    'id' => $datum->getStatus()->getId(),
                    'name' => $datum->getStatus()->getName(),
                    'color' => $datum->getStatus()->getColor(),

                ],
                'priority' => [
                    'id' => $datum->getPriority()->getId(),
                    'name' => $datum->getPriority()->getName(),
                    'color' => $datum->getPriority()->getColor(),
                ],
            ];
        }

        return $tasks;
    }
}