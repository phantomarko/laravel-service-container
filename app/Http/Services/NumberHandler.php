<?php

namespace App\Http\Services;

use App\Http\Rules\NumberRule;

class NumberHandler
{
    private $rule;
    private $generator;
    private $handler;

    public function __construct(NumberRule $rule, DataGenerator $generator, ?NumberHandler $handler = null)
    {
        $this->rule = $rule;
        $this->generator = $generator;
        $this->handler = $handler;
    }

    public function handle(int $number): ?string
    {
        if ($this->rule->isSatisfied($number)) {
            return $this->generator->generate($number);
        } elseif (!empty($this->handler)) {
            return $this->handler->handle($number);
        } else {
            return null;
        }
    }
}
