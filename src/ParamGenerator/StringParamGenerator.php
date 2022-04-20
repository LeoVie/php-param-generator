<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\ParamGenerator;

use LeoVie\PhpParamGenerator\Configuration\EdgeCaseConfigurationInterface;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use LeoVie\PhpParamGenerator\TypeGenerator\StringGenerator;

class StringParamGenerator implements ParamGenerator
{
    private const SUPPORTED_REQUEST = StringRequest::class;

    public function __construct(
        private StringGenerator                $stringGenerator,
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

        return StringParam::create($this->stringGenerator->generate());
    }
}