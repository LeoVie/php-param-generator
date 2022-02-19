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
}