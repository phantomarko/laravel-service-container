<?php

namespace App\Http\Rules;

class NumberIsMultipleOfAnotherRule implements NumberRule
{
    private $multipleOf;

    public function __construct(int $multipleOf)
    {
        $this->multipleOf = $multipleOf;
    }

    public function isSatisfied(int $number): bool
    {
        return $number % $this->multipleOf === 0;
    }
}
