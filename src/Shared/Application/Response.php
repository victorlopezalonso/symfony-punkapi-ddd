<?php

namespace Vlopez\Shared\Application;

use JsonSerializable;

class Response implements JsonSerializable
{
    protected $response;

    public function __construct($item)
    {
        $this->response = static::transform($item);
    }

    public function transform($item) :array
    {
        return [];
    }

    public static function collection($array): array
    {
        return array_map(function ($item) {
            return new static($item);
        }, $array);
    }

    public function jsonSerialize()
    {
        return $this->response;
    }
}
