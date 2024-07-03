<?php

namespace App\Roles\Domain\Entity;

class Role
{
    readonly int $id;
    readonly string $name;
    readonly string $key;

    public function __construct()
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKey(): string
    {
        return $this->key;
    }
}