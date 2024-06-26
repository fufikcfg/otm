<?php

namespace App\Users\Application\UseCase\Query;

use App\Shared\Application\Query\Query;

readonly class GetUserByIdQuery extends Query
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