<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\TestDouble\ParamGenerator;

use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\ParamGenerator;
use LeoVie\PhpParamGenerator\ParamGenerator\ParamGeneratorFinderInterface;

class ParamGeneratorFinderDouble implements ParamGeneratorFinderInterface
{
    /** @param ParamGenerator[] $paramGenerators */
    public function __construct(private array $paramGenerators)
    {
    }

    public function getConcreteParamGenerator(ParamRequest $request): ParamGenerator
    {
        return $this->paramGenerators[$request::class];
    }
}