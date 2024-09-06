<?php

namespace App\Shared\Infrastructure\Formatter\Collection;

interface CollectionFormatterInterface
{
    public function handle(): array;
}