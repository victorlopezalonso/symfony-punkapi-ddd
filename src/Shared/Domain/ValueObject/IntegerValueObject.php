<?php

namespace Vlopez\Shared\Domain\ValueObject;

class IntegerValueObject
{
    protected $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
