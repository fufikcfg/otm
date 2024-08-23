<?php

namespace App\Shared\Infrastructure\Field;

use App\Shared\Infrastructure\Attribute\FieldAttributeAbstract;

class DateTime extends FieldAttributeAbstract
{
    public static function make(mixed $key, ?string $name = null): self
    {
        return new self($key, $name);
    }

    public function handle(mixed $value): string
    {
        return $value instanceof \DateTime
            ? $value->format('m.d.Y i:H') : $value;
    }
}