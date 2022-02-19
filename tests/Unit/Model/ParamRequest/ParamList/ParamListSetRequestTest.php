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
    public function testGetParamListRequest(ParamListRequest $paramListRequest): void
    {
        self::assertSame(
            $paramListRequest,
            ParamListSetRequest::create($paramListRequest, 1)->getParamListRequest()
        );
    }

    public function getParamListRequestProvider(): array
    {
        return [
            [ParamListRequest::create([IntRequest::create()])],
            [ParamListRequest::create([IntRequest::create(), StringRequest::create()])]
        ];
    }

    /** @dataProvider getCountProvider */
    public function testGetCount(int $count): void
    {
        self::assertSame(
            $count,
            ParamListSetRequest::create(ParamListRequest::create([]), $count)->getCount()
        );
    }

    public function getCountProvider(): array
    {
        return [
            [1],
            [99]
        ];
    }
}