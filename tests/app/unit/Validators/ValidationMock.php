<?php

namespace Tests\app\unit\Validators;

use App\Validators\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class ValidationMock extends Validation
{
    public function toArray() :array
    {
        return [
            'number' => new Assert\Positive(),
            'notNull' => new Assert\NotNull(),
        ];
    }
}
