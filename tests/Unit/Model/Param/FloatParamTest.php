<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\Param;

use LeoVie\PhpParamGenerator\Model\Param\FloatParam;
use PHPUnit\Framework\TestCase;

class FloatParamTest extends TestCase
{
    /** @dataProvider getValueProvider */
    public function testGetValue(float $expected, FloatParam $param): void
    {
        self::assertSame($expected, $param->getValue());
    }

    public function getValueProvider(): array
    {
        return [
            [
                'expected' => 10.01,
                FloatParam::create(10.01),
            ],
            [
                'expected' => -0.00006 ,
                FloatParam::create(-0.00006),
            ],
        ];
    }

    /** @dataProvider flattenProvider */
    public function testFlatten(float $expected, FloatParam $param): void
    {
        self::assertSame($expected, $param->flatten());
    }

    public function flattenProvider(): array
    {
        return [
            [
                'expected' => 10.01,
                FloatParam::create(10.01),
            ],
            [
                'expected' => -0.00006 ,
                FloatParam::create(-0.00006),
            ],
        ];
    }

    /** @dataProvider toStringProvider */
    public function testToString(string $expected, FloatParam $param): void
    {
        self::assertSame($expected, $param->__toString());
    }

    public function toStringProvider(): array
    {
        return [
            [
                'expected' => 'FLOAT_PARAM(10.01000000)',
                FloatParam::create(10.01),
            ],
            [
                'expected' => 'FLOAT_PARAM(-0.00006000)',
                FloatParam::create(-0.00006),
            ],
        ];
    }
}