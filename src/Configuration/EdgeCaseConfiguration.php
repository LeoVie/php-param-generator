<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Configuration;

use LeoVie\PhpParamGenerator\Exception\NoEdgeCasesFoundForParamRequest;
use LeoVie\PhpParamGenerator\Model\Param\FloatParam;
use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use LeoVie\PhpParamGenerator\Model\ParamRequest\FloatRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;

class EdgeCaseConfiguration implements EdgeCaseConfigurationInterface
{
    /**
     * @return array<int, Param>
     *
     * @throws NoEdgeCasesFoundForParamRequest
     */
    public function getEdgeCasesByParamRequest(ParamRequest $paramRequest): array
    {
        return match (true) {
            $paramRequest instanceof IntRequest => [
                1 => IntParam::create(0),
                2 => IntParam::create(PHP_INT_MAX),
                3 => IntParam::create(PHP_INT_MIN),
            ],
            $paramRequest instanceof FloatRequest => [
                1 => FloatParam::create(0),
                2 => FloatParam::create(PHP_FLOAT_MAX),
                3 => FloatParam::create(PHP_FLOAT_MIN),
            ],
            $paramRequest instanceof StringRequest => [
                1 => StringParam::create(''),
                2 => StringParam::create($this->longString()),
            ],
            default => throw NoEdgeCasesFoundForParamRequest::create($paramRequest::class)
        };
    }

    private function longString(): string
    {
        return \Safe\file_get_contents(__DIR__ . '/../../pre_generated/long_string.txt');
    }
}