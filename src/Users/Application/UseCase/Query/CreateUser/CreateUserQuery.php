<?php

namespace App\Users\Application\UseCase\Query\CreateUser;

use App\Shared\Application\Query\Query;

readonly class CreateUserQuery extends Query
{
    public function __construct(
        public string $middleName,
        public string $givenName,
        public string $familyName,
        public string $username,
        public string $email,
        public string $password,
    ) {
    }
}