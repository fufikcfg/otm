<?php

namespace App\Shared\Infrastructure\Schema;

interface SchemaInterface
{
    public function fields(array $data): array;
}