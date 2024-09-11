<?php

namespace App\Workflow\Application\UseCase\DTO\TaskStatus;

class TaskStatusDTOTransformer
{
    public function toArray(array $data): array
    {
        $tasks = [];

        foreach ($data as $datum) {
            $tasks[] = [
                'id' => $datum->getId(),
                'name' => $datum->getName(),
                'color' => $datum->getColor(),
            ];
        }

        return $tasks;
    }
}