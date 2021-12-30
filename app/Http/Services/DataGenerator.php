<?php

namespace App\Http\Services;

interface DataGenerator
{
    public function byNumber(int $number): string;
}
