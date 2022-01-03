<?php

namespace App\Http\Rules;

class ValidNumberRule implements NumberRule
{

    public function isSatisfied(int $number): bool
    {
        return true;
    }
}
