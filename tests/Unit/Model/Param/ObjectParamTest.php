<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\Param;

use LeoVie\PhpParamGenerator\Model\Param\ObjectParam;
use PHPUnit\Framework\TestCase;

class ObjectParamTest extends TestCase
{
    /** @dataProvider getValueProvider */
    public function testGetValue(object $expected, ObjectParam $param): void
    {
        self::assertSame($expected, $param->getValue());
    }

    public function getValueProvider(): array
    {
        $class = new ExampleClass();

        return [
            [
                'expected' => $class,
                ObjectParam::create($class),
            ],
        ];
    }

    /** @dataProvider flattenProvider */
    public function testFlatten(string $expected, ObjectParam $param): void
    {
        self::assertSame($expected, $param->flatten());
    }

    public function flattenProvider(): array
    {
        $class = new ExampleClass();

        return [
            [
                'expected' => 'O:60:"LeoVie\PhpParamGenerator\Tests\Unit\Model\Param\ExampleClass":1:{i:0;s:3:"foo";}',
                ObjectParam::create($class),
            ],
        ];
    }

    /** @dataProvider hashProvider */
    public function testHash(string $expected, ObjectParam $param): void
    {
        self::assertSame($expected, $param->hash());
    }

    public function hashProvider(): array
    {
        $class = new ExampleClass();

        return [
            [
                'expected' => 'OBJECT_PARAM(O:60:"LeoVie\PhpParamGenerator\Tests\Unit\Model\Param\ExampleClass":1:{i:0;s:3:"foo";})',
                ObjectParam::create($class),
            ],
        ];
    }
}

class ExampleClass
{
    public function __serialize(): array
    {
        return ['foo'];
    }
}