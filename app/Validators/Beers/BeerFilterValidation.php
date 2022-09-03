<?php

namespace App\Validators\Beers;

use App\Validators\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class BeerFilterValidation extends Validation
{
    public function toArray() :array
    {
        return [
            'page' => new Assert\Positive([
                'message' => 'Page should be a positive number'
            ]),
            'perPage' => new Assert\Optional([
                new Assert\Positive([
                    'message' => 'perPage should be a positive number'
                ])
            ]),
            'food' => new Assert\Optional([
                new Assert\Length([
                    'min' => 3,
                    'minMessage' => 'Search requires at least 3 characters'
                ])
            ]),
        ];
    }
}
