<?php

namespace App\Http\UseCases;

use App\Http\Services\DataGenerator;
use App\Http\Services\StringTransformer;

class ProcessString
{
    /** @var StringTransformer[]  */
    private $stringTransformers;
    /** @var DataGenerator[] */
    private $dataGenerators;

    public function __construct(array $stringTransformers, array $dataGenerators)
    {
        $this->stringTransformers = $stringTransformers;
        $this->dataGenerators = $dataGenerators;
    }

    public function exec(string $string): string
    {
        if (is_numeric($string)) {
            return $this->dataGenerators[array_rand($this->dataGenerators)]
                ->byNumber(intval($string));
        } else {
            return $this->stringTransformers[array_rand($this->stringTransformers)]
                ->transform($string);
        }
    }
}
