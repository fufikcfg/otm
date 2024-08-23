<?php

namespace App\Shared\Infrastructure\Attribute;

use App\Shared\Infrastructure\Field\Relation;

abstract class FieldAttributeAbstract extends AttributeAbstract
{
    private bool $relation = false;

    public function __construct(mixed $key, mixed $name)
    {
        parent::__construct($key, $name);
        if ($this instanceof Relation)
        {
            $this->setRelation(true);
        }
    }

    public function isRelation(): bool
    {
        return $this->relation;
    }

    public function setRelation(bool $relation): void
    {
        $this->relation = $relation;
    }
}