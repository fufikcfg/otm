<?php

namespace App\Shared\Infrastructure\Responder;

use Symfony\Component\HttpFoundation\JsonResponse;

abstract class ResponderAbstract extends JsonResponse implements ResponderInterface
{
    public function __construct(
        readonly private int   $id,
        readonly private array $attributes,
    ) {
        parent::__construct();
        $this->setData(
            [
            'jsonapi' =>
                [
                    'version' => $this->version(),
                ],
            'data' => [
                'type' => $this->type(),
                'id' => $this->getId(),
                'attributes' => [
                    $this->attributes,
                ]
            ]
        ]);
    }

    abstract function version(): string;

    abstract function type(): string;

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getId(): int
    {
        return $this->id;
    }
}