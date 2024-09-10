<?php

namespace App\Shared\Infrastructure\Formatter\Response;

use App\Shared\Infrastructure\Attribute\AttributeInterface;
use App\Shared\Infrastructure\Field\ID;
use App\Shared\Infrastructure\Formatter\Collection\CollectionFormatterInterface;

// TODO Need refactoring
class ResponseFormatter
{
    private array $response = [];

    public function format(CollectionFormatterInterface $collection): array
    {
        return $this->makeResponse($collection->handle());
    }

    private function makeResponse(array $attributes): array
    {
        $relations = [];
        $responseAttributes = [];

        $type = $attributes['type'];
        unset($attributes['type']);

        foreach ($attributes as $key => $attribute) {
            $id = null;

            foreach ($attribute as $attributeKey => $value) {
                if (is_a($value, ID::class)) {
                    $id = $value->getValue();
                }

                if (is_a($value, AttributeInterface::class) && !is_array($value) && !is_a($value, ID::class)) {
                    $responseAttributes[$value->getName()] = $value->getValue();
                }

                if ($attributeKey === 'relations') {
                    foreach ($value as $relation) {
                        $relationType = $relation['type'];
                        unset($relation['type']);
                        $relationAttributes = [];

                        foreach ($relation as $relationValue) {
                            if (is_a($relationValue, ID::class)) {
                                $relationId = $relationValue->getValue();
                            }

                            if (is_a($relationValue, AttributeInterface::class) && !is_a($relationValue, ID::class)) {
                                $relationAttributes[$relationValue->getName()] = $relationValue->getValue();
                            }
                        }

                        $relations[$relationType] = $this->getRelationStructure($relationType, $relationId, $relationAttributes);
                    }
                }
            }

            $this->response[$key] = $this->getBaseStructure(
                $type,
                $id ?? throw new \InvalidArgumentException('Invalid ID - attribute value'),
                $responseAttributes,
            );
            if (!empty($relations)) {
                $this->response[$key]['relationships'] = $relations;
            }
        }
        return $this->response;
    }

    private function getBaseStructure(string $type, string $id, array $attributes): array
    {
        return [
            'type' => $type,
            'id' => $id,
            'attributes' => $attributes,
        ];
    }

    private function getRelationStructure(string $type, string $id, array $attributes): array
    {
        return [
            'data' => [
                'type' => $type,
                'id' => $id,
                'attributes' => $attributes,
            ]
        ];
    }
}