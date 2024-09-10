<?php

namespace App\Shared\Infrastructure\Responder;

use App\Shared\Infrastructure\Formatter\Collection\CollectionFormatter;
use App\Shared\Infrastructure\Formatter\Response\ResponseFormatter;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class ResponderAbstract extends JsonResponse implements ResponderInterface
{
    public function __construct(
        readonly private array $attributes,
        readonly private string $schemaClass
    ) {
        parent::__construct();
        $this->setData(
            $this->formatData()
        );
    }

    private function formatData(): array
    {
        return [
            'jsonapi' => [
                'version' => $this->version(),
            ],
            'data' => $this->response()
        ];
    }

    private function response(): array
    {
        return (new ResponseFormatter)->format(
            new CollectionFormatter($this->attributes, new $this->schemaClass())
        );
    }
}