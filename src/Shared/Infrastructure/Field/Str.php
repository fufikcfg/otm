<?php

namespace App\Shared\Infrastructure\Field;

class Str extends AttributeAbstract
{
    public static function make(mixed $key, ?string $name = null): self
    {
        return new self($key, $name);
    }

    public function handle(mixed $value): string
    {
        return (string) $value;
    }
}