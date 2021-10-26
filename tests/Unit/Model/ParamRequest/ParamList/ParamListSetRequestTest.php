<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\ParamRequest\ParamList;

use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamList\ParamListRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamList\ParamListSetRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use PHPUnit\Framework\TestCase;

class ParamListSetRequestTest extends TestCase
{
    /** @dataProvider getParamListRequestProvider */
    public function testGetParamListRequest(ParamListRequest $expected, ParamListSetRequest $paramListSetRequest): void
    {
        self::assertSame($expected, $paramListSetRequest->getParamListRequest());
    }

    public function getParamListRequestProvider(): \Generator
    {
        $paramListRequest = ParamListRequest::create([IntRequest::create()]);
        yield [
            'expected' => $paramListRequest,
            'paramListSetRequest' => ParamListSetRequest::create($paramListRequest, 1),
        ];

        $paramListRequest = ParamListRequest::create([IntRequest::create(), StringRequest::create()]);
        yield [
            'expected' => $paramListRequest,
            'paramListSetRequest' => ParamListSetRequest::create($paramListRequest, 1),
        ];
    }

    /** @dataProvider getCountProvider */
    public function testGetCount(int $expected, ParamListSetRequest $paramListSetRequest): void
    {
        self::assertSame($expected, $paramListSetRequest->getCount());
    }

    public function getCountProvider(): \Generator
    {
        yield [
            'expected' => 1,
            'paramListSetRequest' => ParamListSetRequest::create(ParamListRequest::create([]), 1),
        ];

        yield [
            'expected' => 99,
            'paramListSetRequest' => ParamListSetRequest::create(ParamListRequest::create([]), 99),
        ];
    }

    /** @dataProvider toStringProvider */
    public function testToString(string $expected, ParamListSetRequest $paramListSetRequest): void
    {
        self::assertSame($expected, $paramListSetRequest->__toString());
    }

    public function toStringProvider(): \Generator
    {
        yield [
            'expected' => 'PARAM_LIST_SET_REQUEST(1x PARAM_LIST_REQUEST())',
            'paramListSetRequest' => ParamListSetRequest::create(ParamListRequest::create([]), 1),
        ];

        yield [
            'expected' => 'PARAM_LIST_SET_REQUEST(99x PARAM_LIST_REQUEST())',
            'paramListSetRequest' => ParamListSetRequest::create(ParamListRequest::create([]), 99),
        ];
    }
}