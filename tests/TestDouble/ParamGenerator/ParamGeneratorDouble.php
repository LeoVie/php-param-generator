<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\TestDouble\ParamGenerator;

use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\ParamGenerator;

class ParamGeneratorDouble implements ParamGenerator
{
    /** @param Param[] $generated */
    public function __construct(private array $generated)
    {
    }

    public function supports(ParamRequest $request): bool
    {
        return true;
    }

    public function generate(ParamRequest $request): Param
    {
        return array_shift($this->generated);
    }
}