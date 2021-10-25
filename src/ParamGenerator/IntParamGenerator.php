<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\ParamGenerator;

use Faker\Generator as FakerGenerator;
use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\Param\Param;

class IntParamGenerator implements ParamGenerator
{
    private const SUPPORTED_REQUEST = IntRequest::class;

    public function __construct(private FakerGenerator $generator)
    {
    }

    public function supports(ParamRequest $request): bool
    {
        return $request::class === self::SUPPORTED_REQUEST;
    }

    public function generate(ParamRequest $request): Param
    {
        return IntParam::create($this->generator->randomNumber());
    }
}