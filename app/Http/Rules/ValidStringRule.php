<?php

namespace App\Http\Rules;

class ValidStringRule implements StringRule
{

    public function isSatisfied(string $string): bool
    {
        return true;
    }
}
