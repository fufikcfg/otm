<?php

namespace App\Users\Application\UseCase\Query\GetUserRoleById;

use App\Shared\Application\Query\Query;

readonly class GetUserRoleByIdQuery extends Query
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