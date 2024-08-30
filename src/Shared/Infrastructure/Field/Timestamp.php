<?php

namespace App\Shared\Infrastructure\Field;

use App\Shared\Infrastructure\Attribute\AttributeAbstract;

class Timestamp extends AttributeAbstract
{
    public function handle(mixed $value): string
    {
        return $value instanceof \DateTime
            ? $value->format('m.d.Y i:H') : $value;
    }
}