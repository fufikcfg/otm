<?php

namespace App\Shared\Infrastructure\Field;

use App\Shared\Infrastructure\Attribute\AttributeAbstract;

class ID extends AttributeAbstract
{
    public function handle(mixed $value): string
    {
        return (string) $value;
    }
}