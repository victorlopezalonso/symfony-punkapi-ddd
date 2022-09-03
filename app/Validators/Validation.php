<?php

namespace App\Validators;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

class Validation implements ValidationInterface
{
    public function validators(): Collection
    {
        return new Assert\Collection($this->toArray());
    }
    
    public function toArray(): array
    {
        return [
            //
        ];
    }
}
