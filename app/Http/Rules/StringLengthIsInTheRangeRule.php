<?php

namespace App\Http\Rules;

class StringLengthIsInTheRangeRule implements StringRule
{
    private $minimumLength;
    private $maximumLength;

    public function __construct(int $minimumLength, int $maximumLength)
    {
        $this->minimumLength = $minimumLength;
        $this->maximumLength = $maximumLength;
    }

    public function isSatisfied(string $string): bool
    {
        $stringLength = strlen($string);
        return $stringLength >= $this->minimumLength && $stringLength <= $this->maximumLength;
    }
}
