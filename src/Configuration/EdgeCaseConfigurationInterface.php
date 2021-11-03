<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Configuration;

use LeoVie\PhpParamGenerator\Exception\NoEdgeCasesFoundForParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\Param\Param;

interface EdgeCaseConfigurationInterface
{
    /**
     * @return array<int, Param>
     *
     * @throws NoEdgeCasesFoundForParamRequest
     */
    public function getEdgeCasesByParamRequest(ParamRequest $paramRequest): array;
}