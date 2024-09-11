<?php

namespace App\Workflow\Infrastructure\Responder\V1;

use App\Shared\Infrastructure\Responder\ResponderAbstract;

class TaskStatusResponder extends ResponderAbstract
{
    function version(): string
    {
        return '1.0';
    }

    function type(): string
    {
        return 'task_statuses';
    }
}