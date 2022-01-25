<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\ParamRequest\ParamList;

use LeoVie\PhpParamGenerator\Model\ParamRequest\ArrayRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamList\ParamListRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use PHPUnit\Framework\TestCase;

class ParamListRequestTest extends TestCase
{
    /** @dataProvider getParamRequestsProvider */
    public function testGetParamRequests(array $paramRequests): void
    {
        self::assertSame($paramRequests, ParamListRequest::create($paramRequests)->getParamRequests());
    }

    public function getParamRequestsProvider(): array
    {
        return [
            [
                [
                    IntRequest::create(),
                    IntRequest::create(),
                ],
            ],
            [
                [
                    IntRequest::create(),
                    StringRequest::create(),
                    ArrayRequest::create([IntRequest::create()])
                ],
            ]
        ];
    }

    /** @dataProvider toStringProvider */
    public function testToString(string $expected, ParamListRequest $paramListRequest): void
    {
        self::assertSame($expected, $paramListRequest->__toString());
    }

    public function toStringProvider(): \Generator
    {
        $paramRequests = [
            IntRequest::create(),
            IntRequest::create(),
        ];
        yield [
            'expected' => 'PARAM_LIST_REQUEST(INT_REQUEST, INT_REQUEST)',
            ParamListRequest::create($paramRequests),
        ];

        $paramRequests = [
            IntRequest::create(),
            StringRequest::create(),
            ArrayRequest::create([IntRequest::create()])
        ];
        yield [
            'expected' => 'PARAM_LIST_REQUEST(INT_REQUEST, STRING_REQUEST, ARRAY_REQUEST(INT_REQUEST))',
            ParamListRequest::create($paramRequests),
        ];
    }
}