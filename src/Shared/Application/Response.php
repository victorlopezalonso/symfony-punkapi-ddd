<?php

namespace Vlopez\Shared\Application;

use JsonSerializable;

class Response implements JsonSerializable
{
    public function __construct($item)
    {
        static::transform($item);
    }

    public function transform($item)
    {
        //
    }

    public static function collection($array): array
    {
        return array_map(function ($item) {
            return (new static($item))->jsonSerialize();
        }, $array);
    }

    public function jsonSerialize(): array
    {
        return (array) $this;
    }
}
