<?php

namespace App\Shared\Infrastructure\Service\FieldInstanceofChecker;

use App\Shared\Infrastructure\Attribute\AttributeInterface;

class FieldInstanceofChecker
{
    public static function execute(AttributeInterface|string $checkedField, string $field): bool
    {
        return $checkedField instanceof $field;
    }
}