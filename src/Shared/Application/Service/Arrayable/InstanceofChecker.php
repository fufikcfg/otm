<?php

namespace App\Shared\Application\Service\Arrayable;

use App\Shared\Application\DTO\ArrayableInterface;

class InstanceofChecker
{
    public static function execute(object ...$class): bool
    {
        foreach ($class as $item) {
            if (!$item instanceof ArrayableInterface)
            {
                return false;
            }
        }
        return true;
    }
}