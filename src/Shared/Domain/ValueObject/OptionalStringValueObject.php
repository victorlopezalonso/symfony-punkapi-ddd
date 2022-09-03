<?php

namespace Vlopez\Shared\Domain\ValueObject;

class OptionalStringValueObject
{
    protected $value;

    public function __construct(?string $value)
    {
        $this->value = $value;
    }

    public function value(): ?string
    {
        return $this->value;
    }
}
