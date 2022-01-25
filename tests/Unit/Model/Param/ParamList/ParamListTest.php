<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\Param\ParamList;

use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\ParamList\ParamList;
use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use PHPUnit\Framework\TestCase;

class ParamListTest extends TestCase
{
    /** @dataProvider getParamsProvider */
    public function testGetParams(array $expected, ParamList $paramList): void
    {
        self::assertSame($expected, $paramList->getParams());
    }

    public function getParamsProvider(): \Generator
    {
        $params = [IntParam::create(10)];
        yield [
            'expected' => $params,
            'paramList' => ParamList::create($params),
        ];

        $params = [
            IntParam::create(10),
            StringParam::create('abc'),
            StringParam::create('def'),
        ];
        yield [
            'expected' => $params,
            'paramList' => ParamList::create($params),
        ];
    }

    /** @dataProvider toStringProvider */
    public function testToString(string $expected, ParamList $paramList): void
    {
        self::assertSame($expected, $paramList->__toString());
    }

    public function toStringProvider(): \Generator
    {
        $params = [IntParam::create(10)];
        yield [
            'expected' => 'PARAM_LIST(INT_PARAM(10))',
            'paramList' => ParamList::create($params),
        ];

        $params = [
            IntParam::create(10),
            StringParam::create('abc'),
            StringParam::create('def'),
        ];
        yield [
            'expected' => 'PARAM_LIST(INT_PARAM(10), STRING_PARAM(abc), STRING_PARAM(def))',
            'paramList' => ParamList::create($params),
        ];
    }
}