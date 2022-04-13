<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\ParamGenerator;

use LeoVie\PhpParamGenerator\Model\Param\NullParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\NullRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;

class NullParamGenerator implements ParamGenerator
{
    private const SUPPORTED_REQUEST = NullRequest::class;

    public function supports(ParamRequest $request): bool
    {
        return $request::class === self::SUPPORTED_REQUEST;
    }

    public function generate(ParamRequest $request, int $index): Param
    {
        return NullParam::create();
    }
}