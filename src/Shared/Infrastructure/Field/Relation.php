<?php

namespace App\Shared\Infrastructure\Field;

use App\Shared\Infrastructure\Attribute\FieldAttributeAbstract;
use App\Shared\Infrastructure\Schema\SchemaInterface;

class Relation extends FieldAttributeAbstract
{
    private SchemaInterface $relationFields;

    // TODO Разобраться с передачей пустого массива на 17 строчке

    public function __construct(mixed $key, mixed $name, private string $relationSchema)
    {
        parent::__construct($key, $name);
        $this->setRelationFields(new $this->relationSchema([]));
    }

    public static function make(mixed $key, ?string $name = null): self
    {
        return throw new \InvalidArgumentException("The MAKE method does not support {${static::class}}.");
    }

    public static function makeWith(mixed $key, string $relationSchema, mixed $name = null): self
    {
        return new static($key, $name, $relationSchema);
    }

    public function handle(mixed $value): mixed
    {
        return [];
    }

    public function setRelationFields(SchemaInterface $relationFields): void
    {
        $this->relationFields = $relationFields;
    }

    public function getRelationFields(): SchemaInterface
    {
        return $this->relationFields;
    }
}