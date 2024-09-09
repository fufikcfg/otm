<?php

namespace App\Shared\Infrastructure\FieldHandlerStorage;

interface FieldHandlerStorageInterface
{
    public function handle(string $fieldType, mixed $value);
}