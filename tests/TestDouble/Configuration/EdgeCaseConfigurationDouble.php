<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\TestDouble\Configuration;

use LeoVie\PhpParamGenerator\Configuration\EdgeCaseConfigurationInterface;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;

class EdgeCaseConfigurationDouble implements EdgeCaseConfigurationInterface
{
    public function __construct(private array $edgeCases)
    {
    }

    public function getEdgeCasesByParamRequest(ParamRequest $paramRequest): array
    {
        return $this->edgeCases;
    }
}