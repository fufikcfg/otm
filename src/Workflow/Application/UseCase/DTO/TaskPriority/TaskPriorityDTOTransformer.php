<?php

namespace App\Workflow\Application\UseCase\DTO\TaskPriority;

class TaskPriorityDTOTransformer
{
    public function toArray(array $data): array
    {
        $priorities = [];

        foreach ($data as $datum) {
            $priorities[] = [
                'id' => $datum->getId(),
                'name' => $datum->getName(),
                'color' => $datum->getColor(),
            ];
        }

        return $priorities;
    }
}