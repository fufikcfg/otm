<?php

namespace App\Shared\Infrastructure\Attribute;

abstract class AttributeAbstract implements AttributeInterface
{
    abstract public static function handle(mixed $value): mixed;

    private readonly string $key;
    private ?string $name;

    public function __construct(string $key, private readonly mixed $value)
    {
        $this->key = $key;
        $this->name = $this->name ?? $this->key;
    }

    public static function make(mixed $key): static
    {
        return new static($key, null);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}