<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\Param;

use LeoVie\PhpParamGenerator\Model\Param\ArrayParam;
use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use PHPUnit\Framework\TestCase;

class ArrayParamTest extends TestCase
{
    /** @dataProvider getValueProvider */
    public function testGetValue(array $expected, ArrayParam $param): void
    {
        self::assertSame($expected, $param->getValue());
    }

    public function getValueProvider(): \Generator
    {
        $params = [IntParam::create(10), StringParam::create('abc')];
        yield [
            'expected' => $params,
            ArrayParam::create($params),
        ];

        $params = [StringParam::create('abc'), StringParam::create('lorem ipsum')];
        yield [
            'expected' => $params,
            ArrayParam::create($params),
        ];
    }

    /** @dataProvider flattenProvider */
    public function testFlatten(array $expected, ArrayParam $param): void
    {
        self::assertSame($expected, $param->flatten());
    }

    public function flattenProvider(): \Generator
    {
        $params = [IntParam::create(10), StringParam::create('abc')];
        yield [
            'expected' => [10, 'abc'],
            ArrayParam::create($params),
        ];

        $params = [StringParam::create('abc'), StringParam::create('lorem ipsum')];
        yield [
            'expected' => ['abc', 'lorem ipsum'],
            ArrayParam::create($params),
        ];
    }
}