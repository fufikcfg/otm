<?php

namespace App\Shared\Infrastructure\Field;

abstract class AttributeAbstract implements AttributeInterface
{
    abstract public static function make(mixed $key, ?string $name = null): self;

    private readonly mixed $key;
    private readonly ?string $name;

    public function __construct(mixed $key, mixed $name)
    {
        $this->key = $key;
        $this->name = $name ?? $this->key;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}