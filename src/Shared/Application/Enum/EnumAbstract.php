<?php

namespace App\Shared\Application\Enum;

use ReflectionClass;

abstract class EnumAbstract implements EnumInterface
{
    private ReflectionClass $instance;

    public function __construct()
    {
        $this->initial();
    }

    public function getValue(string $name): mixed
    {
        return $this->instance->getConstant($name);
    }

    public function getValues(): array
    {
        return $this->instance->getConstants();
    }

    private function initial(): void
    {
        $this->instance = (
            new ReflectionClass(static::class)
        );
    }
}
