<?php

namespace App\Shared\Infrastructure\Responder;

interface ResponderInterface
{
    public function version(): string;
    public function type(): string;
}