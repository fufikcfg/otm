<?php

namespace App\Shared\Application\Enum;

interface EnumInterface
{
    public function getValue(string $name): mixed;
    public function getValues(): array;
}