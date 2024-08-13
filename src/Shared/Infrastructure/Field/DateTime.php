<?php

namespace App\Shared\Infrastructure\Field;

class DateTime extends AttributeAbstract
{
    public static function make(mixed $key, ?string $name = null): self
    {
        return new self($key, $name);
    }

    public function handle(mixed $value): string
    {
        if ($value instanceof \DateTime) {
            return $value->format('m.d.Y i:H');
        }
        return $value;
    }
}