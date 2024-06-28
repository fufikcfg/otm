<?php

namespace App\Users\Infrastructure\Responder;

use App\Shared\Infrastructure\Responder\ResponderAbstract;

class UserResponder extends ResponderAbstract
{
    function version(): string
    {
        return '1.0';
    }

    function type(): string
    {
        return 'users';
    }
}