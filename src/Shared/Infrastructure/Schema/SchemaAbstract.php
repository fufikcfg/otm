<?php

namespace App\Shared\Infrastructure\Schema;

use App\Shared\Infrastructure\Attribute\AttributeInterface;
use App\Shared\Infrastructure\Field\ID;

abstract class SchemaAbstract implements SchemaInterface
{
    private array $fields;

    public function __construct()
    {
        $this->initializeFields();
    }

    abstract public function type(): string;

    abstract public function fields(): array;

    private function initializeFields(): void
    {
        $this->fields = array_merge([ID::make('id')], $this->fields());
        $this->removeUnnecessaryItems();
    }

    private function initializeID(): void
    {
        $this->fields = array_merge([ID::make('id')], $this->fields);
    }

    private function removeUnnecessaryItems(): void
    {
        $fields = $this->fields();

        foreach ($fields as $key => $field) {
            if (!$field instanceof AttributeInterface)
            {
                unset($fields[$key]);
            }
        }

        $this->checkUsedID();
    }

    private function checkUsedID(): void
    {
        $switcher = false;
        foreach ($this->fields() as $field) {
            if (is_a($field, ID::class))
            {
                $switcher = true;
            }
        }
        if ($switcher)
        {
            $this->initializeID();
        }
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}
