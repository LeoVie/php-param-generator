<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\ParamRequest;

class StringRequest implements ParamRequest
{
    public static function create(): self
    {
        return new self();
    }

    public function __toString(): string
    {
        return 'STRING_REQUEST';
    }
}