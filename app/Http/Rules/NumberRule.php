<?php

namespace App\Http\Rules;

interface NumberRule
{
    public function isSatisfied(int $number): bool;
}
