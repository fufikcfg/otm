<?php

namespace App\Shared\Infrastructure\Collection;

use App\Shared\Infrastructure\Field\Relation;
use App\Shared\Infrastructure\Schema\SchemaInterface;
use App\Shared\Infrastructure\Service\FieldInstanceofChecker\FieldInstanceofChecker;
use App\Shared\Infrastructure\Service\FieldSerializer\Serializer\Serializer;

class CollectionFormatter
{
    private array $formatFields;

    public function __construct(
        private array           $data,
        private readonly SchemaInterface $schema
    ) {
    }

    public function handle(): array
    {
        $this->addNesting();
        $this->formatFields();

        return [];
    }

    private function addNesting(): void
    {
        if ($this->identifyNesting() > 0) {
            $this->data = [$this->data];
        }
    }

    private function identifyNesting(): int
    {
        $depth = 0;

        is_array(current($this->data)) ?: $depth++;

        return $depth;
    }

    private function formatFields(): void
    {
        foreach ($this->data as $datumKey => $datum) {
            foreach ($datum as $key => $data) {
                foreach ($this->schema->getFields() as $field) {
                    if ($key == $field->getKey())
                    {
                        if (FieldInstanceofChecker::execute($field, Relation::class))
                        {
                            foreach ($field->getRelationFields()->fields() as $relationField)
                            {
                                foreach ($data as $relationDataKey => $relationData)
                                {
                                    if ($relationDataKey == $relationField->getKey())
                                    {
                                        $this->formatFields[$datumKey][$key][$relationDataKey] =
                                            Serializer::make($field, $field->getKey(), $relationData)->serialize();
                                    }
                                }
                            }
                        } else {
                            $this->formatFields[$datumKey][$key] =
                                Serializer::make($field, $field->getKey(), $data)->serialize();
                        }
                    }
                }
            }
        }
    }
}