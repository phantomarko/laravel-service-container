<?php

namespace App\Http\Services;

use App\Http\Rules\StringRule;

class StringHandler
{
    private $rule;
    private $transformer;
    private $handler;

    public function __construct(StringRule $rule, StringTransformer $transformer, ?StringHandler $handler = null)
    {
        $this->rule = $rule;
        $this->transformer = $transformer;
        $this->handler = $handler;
    }

    public function handle(string $string): ?string
    {
        if ($this->rule->isSatisfied($string)) {
            return $this->transformer->transform($string);
        } elseif (!empty($this->handler)) {
            return $this->handler->handle($string);
        } else {
            return null;
        }
    }
}
