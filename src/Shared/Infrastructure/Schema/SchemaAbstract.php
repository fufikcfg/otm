<?php

namespace App\Shared\Infrastructure\Schema;

use App\Shared\Infrastructure\Attribute\AttributeInterface;
use App\Shared\Infrastructure\Field\ID;

abstract class SchemaAbstract implements SchemaInterface
{
    private array $fields;

    public function __construct()
    {
        $this->handle();
    }

    abstract public function type(): string;

    abstract public function fields(): array;

    public function getFields(): array
    {
        return $this->fields;
    }

    private function handle(): void
    {
        $this->setFields(
            $this->fields()
        );
        $this->removeUnnecessaryItems();
        $this->checkUsedID();
    }

    private function initializeID(): void
    {
        $this->setFields(array_merge([
            ID::make('id')
        ], $this->fields()));
    }

    private function removeUnnecessaryItems(): void
    {
        $fields = $this->getFields();
        foreach ($fields as $key => $field) {
            if (!$field instanceof AttributeInterface)
            {
                unset($fields[$key]);
            }
        }
        $this->setFields($fields);
    }

    private function checkUsedID(): void
    {
        $switcherIdExist = false;

        foreach ($this->getFields() as $field) {
            if (is_a($field, ID::class))
            {
                $switcherIdExist = true;
            }
        }
        if (!$switcherIdExist)
        {
            $this->initializeID();
        }
    }

    private function setFields(array $fields): void
    {
        $this->fields = $fields;
    }
}
