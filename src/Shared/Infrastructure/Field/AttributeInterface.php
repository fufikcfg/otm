<?php

namespace App\Shared\Infrastructure\Field;

interface AttributeInterface
{
    public function getKey(): string;
    public function getName(): ?string;
}