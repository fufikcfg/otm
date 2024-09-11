<?php

namespace App\Users\Application\DTO\UserProject;

use App\Shared\Application\DTO\ArrayableInterface;

readonly class UserProjectDTO implements ArrayableInterface
{
    public function __construct(
        private int $id,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function toArray(): array
    {
        return [
        ];
    }
}