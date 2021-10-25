<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\Param;

use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use PHPUnit\Framework\TestCase;

class StringParamTest extends TestCase
{
    /** @dataProvider getValueProvider */
    public function testGetValue(string $expected, StringParam $param): void
    {
        self::assertSame($expected, $param->getValue());
    }

    public function getValueProvider(): array
    {
        return [
            [
                'expected' => 'abc',
                StringParam::create('abc'),
            ],
            [
                'expected' => 'lorem ipsum dolor sit amet',
                StringParam::create('lorem ipsum dolor sit amet'),
            ],
        ];
    }

    /** @dataProvider flattenProvider */
    public function testFlatten(string $expected, StringParam $param): void
    {
        self::assertSame($expected, $param->flatten());
    }

    public function flattenProvider(): array
    {
        return [
            [
                'expected' => 'abc',
                StringParam::create('abc'),
            ],
            [
                'expected' => 'lorem ipsum dolor sit amet',
                StringParam::create('lorem ipsum dolor sit amet'),
            ],
        ];
    }
}