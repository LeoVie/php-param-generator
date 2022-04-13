<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\Param;

use LeoVie\PhpParamGenerator\Model\Param\BoolParam;
use PHPUnit\Framework\TestCase;

class BoolParamTest extends TestCase
{
    /** @dataProvider getValueProvider */
    public function testGetValue(bool $expected, BoolParam $param): void
    {
        self::assertSame($expected, $param->getValue());
    }

    public function getValueProvider(): array
    {
        return [
            [
                'expected' => true,
                BoolParam::create(true),
            ],
            [
                'expected' => false,
                BoolParam::create(false),
            ],
        ];
    }

    /** @dataProvider flattenProvider */
    public function testFlatten(bool $expected, BoolParam $param): void
    {
        self::assertSame($expected, $param->flatten());
    }

    public function flattenProvider(): array
    {
        return [
            [
                'expected' => true,
                BoolParam::create(true),
            ],
            [
                'expected' => false,
                BoolParam::create(false),
            ],
        ];
    }
}