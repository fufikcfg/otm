<?php

namespace App\Shared\Infrastructure\FieldHandlerStorage;

use App\Shared\Infrastructure\Field\Boolean;
use App\Shared\Infrastructure\Field\DateTime;
use App\Shared\Infrastructure\Field\ID;
use App\Shared\Infrastructure\Field\Relation;
use App\Shared\Infrastructure\Field\Str;

class FieldHandlerStorage implements FieldHandlerStorageInterface
{
    public function handle(string $fieldType, mixed $value)
    {
        return $this->storage($fieldType)($value);
    }

    private function storage(string $fieldType): \Closure
    {
        return [
            Str::class => function ($value) {
                return Str::handle($value);
            },
            Relation::class => function ($value) {
                return Relation::handle($value);
            },
            DateTime::class => function ($value) {
                return DateTime::class::handle($value);
            },
            ID::class => function ($value) {
                return ID::handle($value);
            },
            Boolean::class => function ($value) {
                return Boolean::handle($value);
            }
        ][$fieldType] ?? throw new \InvalidArgumentException(
            "{$fieldType} not found or not supported"
        );
    }
}