<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\ParamGenerator;

use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;

interface ParamGenerator
{
    public function supports(ParamRequest $request): bool;

    public function generate(ParamRequest $request, int $index): Param;
}