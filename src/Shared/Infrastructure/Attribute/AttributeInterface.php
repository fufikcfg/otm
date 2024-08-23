<?php

namespace App\Shared\Infrastructure\Attribute;

interface AttributeInterface
{
    public function getKey(): string;
    public function getName(): ?string;
}