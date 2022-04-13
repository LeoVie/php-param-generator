<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\ParamGenerator;

use Faker\Generator as FakerGenerator;
use LeoVie\PhpParamGenerator\Model\Param\BoolParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\BoolRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;

class BoolParamGenerator implements ParamGenerator
{
    private const SUPPORTED_REQUEST = BoolRequest::class;

    public function __construct(private FakerGenerator $generator)
    {
    }

    public function supports(ParamRequest $request): bool
    {
        return $request::class === self::SUPPORTED_REQUEST;
    }

    public function generate(ParamRequest $request, int $index): Param
    {
        return BoolParam::create($this->generator->boolean());
    }
}