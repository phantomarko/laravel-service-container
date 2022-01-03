<?php

namespace App\Http\UseCases;

use App\Http\Services\NumberHandler;
use App\Http\Services\StringHandler;

class ProcessString
{
    private $stringHandler;
    private $numberHandler;

    public function __construct(StringHandler $stringHandler, NumberHandler $numberHandler)
    {
        $this->stringHandler = $stringHandler;
        $this->numberHandler = $numberHandler;
    }

    public function exec(string $string): string
    {
        if (is_numeric($string)) {
            return $this->numberHandler->handle(intval($string));
        } else {
            return $this->stringHandler->handle($string);
        }
    }
}
