<?php

namespace App\Shared\Infrastructure\Schema;

use InvalidArgumentException;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

abstract class SchemaAbstract implements SchemaInterface
{
    private array $fields;

    public function __construct(
        private array $data
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
        if ($this->identifyNesting() < 1) {
            $this->setData([$this->getData()]);
        }
        return $this->initialAttributes();
    }

    private function initialAttributes(): array
    {
        $attributes = [];

        foreach ($this->diffData() as $key => $data) {
            foreach ($this->getFields() as $field)
            {
                $attributes[$key]['id'] = $this->getId($data);
                $attributes[$key][$field->getName()] = $field->setValue($data[$field->getKey()])->getValue();
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
        return $this->deletingUnnecessaryKeys(
            $this->filteringKeys(
                $this->getKeys()
            )
        );
    }

    private function identifyNesting(): int
    {
        $depth = 0;

        $it = new RecursiveIteratorIterator(new RecursiveArrayIterator(
            $this->getData()
        ));

        foreach ($it as $ignored) {
            $int = $it->getDepth();
            $depth >= $int ?: $depth = $int;
        }

        return $depth;
    }

    private function getKeys(): array
    {
        $keys = ['id'];

        foreach ($this->getFields() as $field)
        {
            $keys[] = $field->getKey();
        }

        return $keys;
    }

    private function filteringKeys(array $keys): array
    {
        $diffKeys = [];

        $data = $this->getData();

        foreach ($data as $datum) {
            $diffKeys[] = array_filter($datum, function($key) use ($keys) {
                return !in_array($key, $keys);
            }, ARRAY_FILTER_USE_KEY);
        }

        return $diffKeys;
    }

    private function deletingUnnecessaryKeys(array $diffKeys): array
    {
        $data = $this->getData();

        foreach ($diffKeys as $key) {
            foreach ($key as $separateKey => $value) {
                foreach ($data as &$datum) {
                    unset($datum[$separateKey]);
                }
            }
        }
        return $data;
    }

    private function getId(array $data, int|string $key = null): string
    {
        return (string) ($key !== null ? $data[$key]['id'] : $data['id'])
            ?? throw new InvalidArgumentException("{$key} not found in data");
    }

    private function getBaseStructure(array $data): array
    {
        $id = $data['id'];
        unset($data['id']);

        return [
            'type' => $this->type(),
            'id' => $id,
            'attributes' => $data,
        ];
    }

    private function makeAttributeStructure(array $data): array
    {
        return array_map(fn ($value) =>
            $this->getBaseStructure($value),
                $data
        );
    }

    private function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    private function getData(): array
    {
        return $this->data;
    }

    private function setData(array $data): void
    {
        $this->data = $data;
    }
}
