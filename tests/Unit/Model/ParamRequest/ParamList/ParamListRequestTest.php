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
    public function testGetParamRequests(array $expected, ParamListRequest $paramListRequest): void
    {
        self::assertSame($expected, $paramListRequest->getParamRequests());
    }

    public function getParamRequestsProvider(): \Generator
    {
        $paramRequests = [
            IntRequest::create(),
            IntRequest::create(),
        ];
        yield [
            'expected' => $paramRequests,
            ParamListRequest::create($paramRequests),
        ];

        $paramRequests = [
            IntRequest::create(),
            StringRequest::create(),
            ArrayRequest::create([IntRequest::create()])
        ];
        yield [
            'expected' => $paramRequests,
            ParamListRequest::create($paramRequests),
        ];
    }
}