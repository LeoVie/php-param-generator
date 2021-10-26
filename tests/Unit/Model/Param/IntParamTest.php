<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\Param;

use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use PHPUnit\Framework\TestCase;

class IntParamTest extends TestCase
{
    /** @dataProvider getValueProvider */
    public function testGetValue(int $expected, IntParam $param): void
    {
        self::assertSame($expected, $param->getValue());
    }

    public function getValueProvider(): array
    {
        return [
            [
                'expected' => 10,
                IntParam::create(10),
            ],
            [
                'expected' => 990,
                IntParam::create(990),
            ],
        ];
    }

    /** @dataProvider flattenProvider */
    public function testFlatten(int $expected, IntParam $param): void
    {
        self::assertSame($expected, $param->flatten());
    }

    public function flattenProvider(): array
    {
        return [
            [
                'expected' => 10,
                IntParam::create(10),
            ],
            [
                'expected' => 990,
                IntParam::create(990),
            ],
        ];
    }

    /** @dataProvider toStringProvider */
    public function testToString(string $expected, IntParam $param): void
    {
        self::assertSame($expected, $param->__toString());
    }

    public function toStringProvider(): array
    {
        return [
            [
                'expected' => 'INT_PARAM(10)',
                IntParam::create(10),
            ],
            [
                'expected' => 'INT_PARAM(990)',
                IntParam::create(990),
            ],
        ];
    }
}