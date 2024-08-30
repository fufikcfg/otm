<?php

namespace App\Shared\Infrastructure\Field;

use App\Shared\Infrastructure\Attribute\AttributeAbstract;

class HashID extends AttributeAbstract
{
    public function handle(mixed $value): string
    {
        return md5($value);
    }
}