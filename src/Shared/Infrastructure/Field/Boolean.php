<?php

namespace App\Shared\Infrastructure\Field;

use App\Shared\Infrastructure\Attribute\AttributeAbstract;

class Boolean extends AttributeAbstract
{
    public static function handle(mixed $value): string
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_int($value)) {
            return $value == '1' ? 'true' : 'false';
        }

        throw new \LogicException("{$value} is not a boolean value");
    }
}