<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Exception;

class NoParamGeneratorFoundForParamRequest extends \Exception
{
    private function __construct(string $paramRequestClass)
    {
        parent::__construct('No ParamGenerator found for ' . $paramRequestClass);
    }

    public static function create(string $paramRequestClass): self
    {
        return new self($paramRequestClass);
    }
}