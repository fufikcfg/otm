<?php

namespace App\Roles\Infrastructure\Responder\V1;

use App\Shared\Infrastructure\Responder\ResponderAbstract;

class RoleResponder extends ResponderAbstract
{
    function version(): string
    {
        return '1.0';
    }

    function type(): string
    {
        return 'roles';
    }
}