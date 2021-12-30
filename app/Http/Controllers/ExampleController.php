<?php

namespace App\Http\Controllers;

use App\Http\UseCases\ProcessString;

class ExampleController extends Controller
{
    private $processString;

    public function __construct(ProcessString $processString)
    {
        $this->processString = $processString;
    }

    public function index(string $string): string
    {
        return $this->processString->exec($string);
    }
}
