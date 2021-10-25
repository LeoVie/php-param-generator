<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Service;

use LeoVie\PhpParamGenerator\Exception\NoParamGeneratorFoundForParamRequest;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\ParamGeneratorStrategy;

class ParamGeneratorService
{
    public function __construct(private ParamGeneratorStrategy $paramGeneratorStrategy)
    {}

    /** @throws NoParamGeneratorFoundForParamRequest */
    public function generate(ParamRequest $request): Param
    {
        return $this->paramGeneratorStrategy
            ->getConcreteParamGenerator($request)
            ->generate($request);
    }
}