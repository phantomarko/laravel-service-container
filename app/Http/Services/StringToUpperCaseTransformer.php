<?php

namespace App\Http\Services;

class StringToUpperCaseTransformer implements StringTransformer
{

    public function transform(string $string): string
    {
        return strtoupper($string);
    }
}
