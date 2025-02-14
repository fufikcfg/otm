<?php

namespace App\Users\Application\UseCase\Query\GetUserProjectById;

use App\Shared\Application\Query\Query;

readonly class GetUserProjectByIdQuery extends Query
{
    public function __construct(
        private int $userId
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}