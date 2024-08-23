<?php

namespace App\Shared\Infrastructure\Responder;

use App\Shared\Infrastructure\Schema\SchemaInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class ResponderAbstract extends JsonResponse implements ResponderInterface
{
    public function __construct(
        readonly private array $attributes,
        readonly private string $schemaClass
    ) {
        parent::__construct();
        $this->setData(
            $this->formatData(
                $this->createSchemaInstance(
                    new $this->schemaClass($this->attributes)
                )
            )
        );
    }

    private function createSchemaInstance(SchemaInterface $schemaInstance): array
    {
        return [
            $schemaInstance->getAttributes()
        ];
    }

    private function formatData(array $data): array
    {
        return [
            'jsonapi' => [
                'version' => $this->version(),
            ],
            'data' => $data
        ];
    }
}