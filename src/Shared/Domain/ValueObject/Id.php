<?php

namespace Vlopez\Shared\Domain\ValueObject;

class Id
{
    protected $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function value(): string
    {
        return $this->id;
    }
}
