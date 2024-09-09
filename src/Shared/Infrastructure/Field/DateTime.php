<?php

namespace App\Shared\Infrastructure\Field;

use App\Shared\Infrastructure\Attribute\AttributeAbstract;

class DateTime extends AttributeAbstract
{
    public static function handle(mixed $value): string
    {
        return $value instanceof \DateTime
            ? $value->format('m.d.Y i:H') : $value;
    }
}