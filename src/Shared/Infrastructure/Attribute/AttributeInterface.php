<?php

namespace App\Shared\Infrastructure\Attribute;

interface AttributeInterface
{
    public static function make(string $key): static;
    public function getKey(): string;
    public function getName(): string;
    public function setName(string $name): self;
}