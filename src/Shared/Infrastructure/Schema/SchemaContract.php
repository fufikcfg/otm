<?php

namespace App\Shared\Infrastructure\Schema;

interface SchemaContract
{
    public function fields(array $data): array;
}