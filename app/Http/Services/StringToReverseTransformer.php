<?php

namespace App\Http\Services;

class StringToReverseTransformer implements StringTransformer
{

    public function transform(string $string): string
    {
        return strrev($string);
    }
}
