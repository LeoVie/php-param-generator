<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\ParamGenerator;

use LeoVie\PhpParamGenerator\Exception\NoParamGeneratorFoundForParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;

interface ParamGeneratorFinderInterface
{
    /** @throws NoParamGeneratorFoundForParamRequest */
    public function getConcreteParamGenerator(ParamRequest $request): ParamGenerator;
}