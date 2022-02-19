<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\ParamRequest;

/** @psalm-immutable */
class IntRequest implements ParamRequest
{
    public static function create(): self
    {
        return new self();
    }
}