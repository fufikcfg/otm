<?php

namespace App\Shared\Infrastructure\Service\FieldSerializer\Serializer;

use App\Shared\Infrastructure\Attribute\AttributeInterface;

interface FieldSerializerInterface
{
    public static function make(AttributeInterface $field, string $key, mixed $value): mixed;
}