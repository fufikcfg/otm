<?php

namespace App\Shared\Domain\Service\Enum;

interface EnumGetterInterface
{
    public function getValue(string $name): mixed;
    public function getValues(): array;
}