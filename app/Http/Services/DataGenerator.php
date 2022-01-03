<?php

namespace App\Http\Services;

interface DataGenerator
{
    public function generate(int $number): string;
}
