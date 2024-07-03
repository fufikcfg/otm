<?php

namespace App\Shared\Domain\Service\Enum;

use App\Shared\Application\Enum\EnumInterface;

abstract class EnumGetterAbstract implements EnumGetterInterface
{
    private EnumInterface $enum;

    abstract function enum(): string;

    public function __construct()
    {
        $this->enum = $this->initial($this->enum());
    }

    public function getValue(string $name): mixed
    {
        return $this->enum->getValue($name)
            ?: throw new \InvalidArgumentException(
                sprintf('Enum value %s does not exist', $name)
            );
    }

    public function getValues(): array
    {
        return $this->enum->getValues();
    }

    private function initial(string $enum): EnumInterface
    {
        if (class_exists($enum) && in_array(EnumInterface::class, class_implements($enum)))
        {
            return new $enum();
        }

        throw new \InvalidArgumentException(
            sprintf('Enum %s does not exist or does not implement EnumInterface', $enum)
        );
    }
}
