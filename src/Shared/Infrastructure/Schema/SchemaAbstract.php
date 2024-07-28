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
                    $attributes[$key][$field->getName()] = $data[$field->getKey()];
                }
            }
        }
        return $attributes;
    }

    public function getId(): string
    {
        return isset($this->data['id']) ? (string)$this->data['id'] : 'undefined';
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
