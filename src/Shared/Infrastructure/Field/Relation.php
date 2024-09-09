<?php

namespace App\Shared\Infrastructure\Field;

use App\Shared\Infrastructure\Attribute\AttributeAbstract;
use App\Shared\Infrastructure\Schema\SchemaInterface;

class Relation extends AttributeAbstract
{
    private SchemaInterface $relationFields;

    public function schema(string $schema): self
    {
        $this->setRelationFields(new $schema);

        return $this;
    }

    public static function handle(mixed $value): mixed
    {
        return $value;
    }

    private function setRelationFields(SchemaInterface $relationFields): void
    {
        $this->relationFields = $relationFields;
    }

    public function getRelationFields(): SchemaInterface
    {
        return $this->relationFields;
    }
}