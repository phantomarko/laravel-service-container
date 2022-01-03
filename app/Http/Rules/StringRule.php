<?php

namespace App\Http\Rules;

interface StringRule
{
    public function isSatisfied(string $string): bool;
}
