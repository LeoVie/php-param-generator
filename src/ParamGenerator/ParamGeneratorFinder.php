<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\ParamGenerator;

use LeoVie\PhpParamGenerator\Exception\NoParamGeneratorFoundForParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;

class ParamGeneratorFinder implements ParamGeneratorFinderInterface
{
    /** @param iterable<ParamGenerator> $paramGenerators */
    public function __construct(private iterable $paramGenerators)
    {
    }

    /** @throws NoParamGeneratorFoundForParamRequest */
    public function getConcreteParamGenerator(ParamRequest $request): ParamGenerator
    {
        foreach ($this->paramGenerators as $paramGenerator) {
            if ($paramGenerator->supports($request)) {
                return $paramGenerator;
            }
        }

        throw NoParamGeneratorFoundForParamRequest::create($request::class);
    }
}