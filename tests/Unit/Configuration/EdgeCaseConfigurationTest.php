<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Configuration;

use LeoVie\PhpParamGenerator\Configuration\EdgeCaseConfiguration;
use LeoVie\PhpParamGenerator\Exception\NoEdgeCasesFoundForParamRequest;
use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use PHPUnit\Framework\TestCase;

class EdgeCaseConfigurationTest extends TestCase
{
    /** @dataProvider getEdgeCasesByParamRequestProvider */
    public function testGetEdgeCasesByParamRequest(array $expected, ParamRequest $paramRequest): void
    {
        self::assertEquals($expected, (new EdgeCaseConfiguration())->getEdgeCasesByParamRequest($paramRequest));
    }

    public function getEdgeCasesByParamRequestProvider(): array
    {
        return [
            'IntRequest' => [
                'expected' => [
                    1 => IntParam::create(0),
                    2 => IntParam::create(PHP_INT_MAX),
                    3 => IntParam::create(PHP_INT_MIN),
                ],
                'paramRequest' => IntRequest::create(),
            ],
            'StringRequest' => [
                'expected' => [
                    1 => StringParam::create(''),
                    2 => StringParam::create($this->longString()),
                ],
                'paramRequest' => StringRequest::create(),
            ],
        ];
    }

    private function longString(): string
    {
        return \Safe\file_get_contents(__DIR__ . '/../../../pre_generated/long_string.txt');
    }

    public function testGetEdgeCasesThrows(): void
    {
        self::expectException(NoEdgeCasesFoundForParamRequest::class);

        (new EdgeCaseConfiguration())->getEdgeCasesByParamRequest($this->createMock(ParamRequest::class));
    }
}