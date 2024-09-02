<?php

namespace App\Shared\Infrastructure\Collection;

use App\Shared\Infrastructure\Attribute\AttributeInterface;
use App\Shared\Infrastructure\Field\Relation;
use App\Shared\Infrastructure\Schema\SchemaInterface;
use App\Shared\Infrastructure\Service\FieldInstanceofChecker\FieldInstanceofChecker;
use App\Shared\Infrastructure\Service\FieldSerializer\Serializer\Serializer;

//TODO Добавить типы аргументов
class CollectionFormatter
{
    private array $formattedFields;

    public function __construct(
        private array $data,
        private readonly SchemaInterface $schema
    ) {
    }

    public function handle(): array
    {
        $this->addNesting();
        $this->format();
        return $this->formattedFields;
    }

    private function format(): void
    {
        foreach ($this->data as $datumKey => $datum) {
            foreach ($datum as $key => $value) {
                $this->processFields($datumKey, $key, $value);
            }
        }
    }

    private function processFields($datumKey, $key, $value): void
    {
        foreach ($this->schema->getFields() as $field) {
            if ($this->keyMatches($key, $field->getKey())) {
                FieldInstanceofChecker::execute($field, Relation::class)
                    ? $this->handleRelation($field, $value, $datumKey, $key)
                    : $this->serializeAndStore($field, $value, $datumKey, $key);
            }
        }
    }

    private function handleRelation($field, $value, $datumKey, $key): void
    {
        foreach ($field->getRelationFields()->fields() as $relationField) {
            $relationKey = $relationField->getKey();
            if (isset($value[$relationKey])) {
                $this->serializeAndStore($field, $value[$relationKey], $datumKey, $key, $relationKey);
            }
        }
    }

    private function keyMatches($dataKey, $fieldKey): bool
    {
        return $dataKey === $fieldKey;
    }

    private function serializeAndStore(AttributeInterface $field, $value, string $primaryKey, string $foreignKey, ?string $relationKey = null): void
    {
        $serializer = Serializer::make($field, $field->getKey(), $value)->serialize();
        if ($relationKey !== null) {
            $this->formattedFields[$primaryKey][$foreignKey][$relationKey] = $serializer;
        } else {
            $this->formattedFields[$primaryKey][$foreignKey] = $serializer;
        }
    }

    private function addNesting(): void
    {
        if ($this->needsNesting()) {
            $this->data = [$this->data];
        }
    }

    private function needsNesting(): bool
    {
        return !is_array(current($this->data));
    }
}
