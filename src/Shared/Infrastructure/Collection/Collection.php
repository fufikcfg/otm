<?php

namespace App\Shared\Infrastructure\Collection;

use App\Shared\Infrastructure\Schema\SchemaInterface;

class Collection
{
    public function __construct(
        private array $data,
        private SchemaInterface $schema
    ) {
    }

    public function __invoke()
    {


//        return $this->handle($this->data);
    }

}