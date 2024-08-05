<?php

namespace App\Shared\Infrastructure\Schema;

abstract class SchemaAbstract implements SchemaInterface
{
    // TODO Need refactoring
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
        $diffData = $this->diffData();

        foreach ($diffData as $key => $data) {
            foreach ($this->getFields() as $field)
            {
                $attributes[$key]['id'] = $this->getId($data);
                $attributes[$key][$field->getName()] = $data[$field->getKey()];
            }
        }
        return $this->makeAttributeStructure($attributes);
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    private function diffData(): array
    {
        $data = $this->getData();
        $keys = ['id'];

        foreach ($this->getFields() as $field)
        {
            $keys[] = $field->getKey();
        }

        foreach ($data as $datum) {
            $diffKeys[] = array_filter($datum, function($key) use ($keys) {
                return !in_array($key, $keys);
            }, ARRAY_FILTER_USE_KEY);
        }

        foreach ($diffKeys as $key)
        {
            foreach ($key as $separateKey => $value)
            {
                for ($i = 0; $i < count($data); $i++)
                {
                    unset($data[$i][$separateKey]);
                }
            }
        }

        return $data;
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
}
