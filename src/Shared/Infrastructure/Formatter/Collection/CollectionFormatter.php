<?php

namespace App\Shared\Infrastructure\Formatter\Collection;

use App\Shared\Infrastructure\Attribute\AttributeInterface;
use App\Shared\Infrastructure\Field\Relation;
use App\Shared\Infrastructure\Schema\SchemaInterface;
use App\Shared\Infrastructure\Service\FieldInstanceofChecker\FieldInstanceofChecker;
use App\Shared\Infrastructure\Service\FieldSerializer\Serializer\Serializer;

//TODO Добавить типы аргументов
class CollectionFormatter implements CollectionFormatterInterface
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
        $this->typeDefine();
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

    private function typeDefine(): void
    {
        $this->formattedFields['type'] = $this->schema->type();
        $this->relationTypeDefine();
    }

    private function relationTypeDefine(): void
    {
        foreach ($this->formattedFields as $keyField => $field)
        {
            if (isset($field['relations']))
            {
                foreach ($this->schema->fields() as $schemaField)
                {
                    if (FieldInstanceofChecker::execute($schemaField, Relation::class))
                    {
                        $this->formattedFields[$keyField]['relations'][$schemaField->getKey()]['type'] =
                            $schemaField->getRelationFields()->type();
                    }
                }
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

    // TODO Если будет много отношений, то обновлять здесь
    private function handleRelation($field, $value, $datumKey, $key): void
    {
        foreach ($field->getRelationFields()->getFields() as $relationField) {
            $relationKey = $relationField->getKey();
            if (isset($value[$relationKey])) {
                $this->serializeAndStore($relationField, $value[$relationKey], $datumKey, $key, $relationKey);
            }
        }
    }

    private function keyMatches($dataKey, $fieldKey): bool
    {
        return $dataKey === $fieldKey;
    }

    private function serializeAndStore(AttributeInterface $field, $value, string $primaryKey, string $foreignKey, ?string $relationKey = null): void
    {
        $serializer = Serializer::make($field, $field->getKey(), $value);
        if ($relationKey !== null) {
            $this->formattedFields[$primaryKey]['relations'][$foreignKey][$relationKey] = $serializer;
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
