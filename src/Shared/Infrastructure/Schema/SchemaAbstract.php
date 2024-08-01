<?php

namespace App\Shared\Infrastructure\Schema;

abstract class SchemaAbstract implements SchemaContract
{
    private array $fields;

    public function __construct(
        private readonly array $data
    )
    {
        $this->setFields(
            $this->fields($this->data)
        );
    }

    abstract public function type(): string;

    abstract public function fields(array $data): array;

    public function getAttributes(): array
    {
        $attributes = [];

        foreach ($this->getData() as $key => $data) {
            foreach ($this->getFields() as $field)
            {
                if(isset($data[$field->getKey()]))
                {
                    $attributes[$key]['id'] = $this->getId($data);
                    $attributes[$key][$field->getName()] = $data[$field->getKey()];
                }
            }
        }
        return $this->makeAttributeStructure($attributes);
    }

    private function getId(array $data, int|string $key = null): string
    {
        if (isset($key))
        {
            return (string) $data[$key]['id'];
        }
        return (string) $data['id'] ??
            throw new \InvalidArgumentException("{$key} not found in data");
    }

    private function makeAttributeStructure(array $data): array
    {
        $attributes = [];

        foreach ($data as $value)
        {
            $attributes[] = $this->getBaseStructure($value);
        }

        return $attributes;
    }

    private function getBaseStructure(array $data): array
    {
        $structure = [
            'type' => $this->type(),
            'id' => $data['id'],
            'attributes' => [],
        ];

        $attributes = $data;
        unset($attributes['id']);

        $structure['attributes'] = $attributes;

        return $structure;
    }



    private function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    private function getData(): array
    {
        return $this->data;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}
