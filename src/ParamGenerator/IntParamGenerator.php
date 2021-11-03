<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\ParamGenerator;

use Faker\Generator as FakerGenerator;
use LeoVie\PhpParamGenerator\Configuration\EdgeCaseConfigurationInterface;
use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;

class IntParamGenerator implements ParamGenerator
{
    private const SUPPORTED_REQUEST = IntRequest::class;

    public function __construct(
        private FakerGenerator $generator,
        private EdgeCaseConfigurationInterface $edgeCaseConfiguration,
    )
    {
    }

    public function supports(ParamRequest $request): bool
    {
        return $request::class === self::SUPPORTED_REQUEST;
    }

    public function generate(ParamRequest $request, int $index): Param
    {
        $edgeCases = $this->edgeCaseConfiguration->getEdgeCasesByParamRequest($request);
        if (array_key_exists($index, $edgeCases)) {
            return $edgeCases[$index];
        }

        return IntParam::create($this->generator->randomNumber());
    }
}