<?php

namespace App\Shared\Infrastructure\Service\FieldSerializer\Serializer;

use App\Shared\Infrastructure\Attribute\AttributeInterface;
use App\Shared\Infrastructure\FieldHandlerStorage\FieldHandlerStorage;
use App\Shared\Infrastructure\FieldHandlerStorage\FieldHandlerStorageInterface;

class Serializer implements FieldSerializerInterface
{
    private static mixed $value;
    private static mixed $key;

    public function __construct(
        private readonly mixed               $valueField,
        private readonly AttributeInterface  $field,
        private readonly FieldHandlerStorageInterface $storage
    ) {
    }

    public static function make(AttributeInterface $field, string $key, mixed $value): mixed
    {
        return (new self(
            $value,
            new $field(
                self::$key = $key, self::$value = $value
            ),
            new FieldHandlerStorage()
        ))->serialize();
    }

    private function serialize(): mixed
    {
        return new $this->field(self::$key, $this->storage->handle($this->field::class, $this->valueField));
    }
}