<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Exception;

class NoEdgeCasesFoundForParamRequest extends \Exception
{
    private function __construct(string $paramRequestClass)
    {
        parent::__construct('No edge cases found for ' . $paramRequestClass);
    }

    public static function create(string $paramRequestClass): self
    {
        return new self($paramRequestClass);
    }
}