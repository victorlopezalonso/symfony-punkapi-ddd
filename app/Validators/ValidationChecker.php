<?php

namespace App\Validators;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationChecker
{
    private $violations;

    public function __construct(ConstraintViolationListInterface $violations)
    {
        $this->violations = $violations;
    }

    public function fails() :bool
    {
        return $this->violations->count();
    }

    public function errors() :array
    {
        $errors = [];

        foreach ($this->violations as $violation) {
            $key = str_replace(['[', ']'], ['', ''], $violation->getPropertyPath());
            $errors[$key] = $violation->getMessage();
        }

        return $errors;
    }
}
