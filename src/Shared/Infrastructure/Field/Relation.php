<?php

namespace App\Shared\Infrastructure\Field;

use App\Shared\Infrastructure\Attribute\FieldAttributeAbstract;
use App\Shared\Infrastructure\Schema\SchemaInterface;

class Relation extends FieldAttributeAbstract
{
    private SchemaInterface $relationFields;
    private string $primaryKey;
    private string $type;

    // TODO Разобраться с передачей пустого массива на 19 строчке

    public function __construct(mixed $key, mixed $name, private string $relationSchema)
    {
        parent::__construct($key, $name);
        $this->setRelationFields(new $this->relationSchema([]));
        $this->setType();
    }

    public static function make(mixed $key, ?string $name = null): never
    {
        exit();
    }

    public static function makeWith(mixed $key, string $relationSchema, mixed $name = null): self
    {
        return new static($key, $name, $relationSchema);
    }

    public function handle(mixed $value): array
    {
        return $value;
    }

    public function setRelationFields(SchemaInterface $relationFields): void
    {
        $this->relationFields = $relationFields;
    }

    public function getRelationFields(): SchemaInterface
    {
        return $this->relationFields;
    }

    public function setPrimaryKey(string $primaryKey): void
    {
        $this->primaryKey = $primaryKey;
    }

    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(): void
    {
        $this->type = $this->getRelationFields()->type();
    }
}