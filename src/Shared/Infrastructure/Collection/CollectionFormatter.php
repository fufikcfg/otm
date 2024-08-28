<?php

namespace App\Shared\Infrastructure\Collection;

use App\Shared\Infrastructure\Schema\SchemaInterface;

class CollectionFormatter
{
    private array $formatFields;

    public function __construct(
        private array           $data,
        private SchemaInterface $schema
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

    // TODO Need refactoring
    private function formatFields(): void
    {
        foreach ($this->data as $datumKey => $datum) {
            foreach ($datum as $key => $data) {
                foreach ($this->schema->getFields() as $field) {
                    if ($key == 'id')
                    {
                        $this->formatFields[$datumKey][$key] = $data;
                    }
                    if ($key == $field->getKey())
                    {
                        if ($field->isRelation())
                        {
                            foreach ($field->getRelationFields()->fields() as $relationField)
                            {
                                foreach ($data as $relationDataKey => $relationData)
                                {
                                    if ($relationDataKey == 'id')
                                    {
                                        $this->formatFields[$datumKey][$key][$relationDataKey] = $relationData;
                                    }

                                    if ($relationDataKey == $relationField->getKey())
                                    {
                                        $this->formatFields[$datumKey][$key][$relationDataKey] = (clone $relationField)->setValue($relationData);
                                    }
                                }
                            }
                        } else {
                            $this->formatFields[$datumKey][$key] = (clone $field)->setValue($data);
                        }
                    }
                }
            }
        }
        dd($this->formatFields);
    }
}