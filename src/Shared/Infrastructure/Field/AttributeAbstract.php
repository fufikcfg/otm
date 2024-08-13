<?php

namespace App\Shared\Infrastructure\Field;

abstract class AttributeAbstract implements AttributeInterface
{
    abstract public static function make(mixed $key, ?string $name = null): self;
    abstract public function handle(mixed $value): mixed;

    private readonly mixed $key;
    private readonly ?string $name;
    private mixed $value;

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

    public function getValue(): mixed
    {
        return $this->handle($this->value);
    }

    public function setValue(mixed $value): self
    {
        $this->value = $value;

        return $this;
    }
}