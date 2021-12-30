<?php

namespace App\Http\Services;

interface StringTransformer
{
    public function transform(string $string): string;
}
