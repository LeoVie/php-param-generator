<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\ParamRequest;

use LeoVie\PhpParamGenerator\Model\ParamRequest\ArrayRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use PHPUnit\Framework\TestCase;

class ArrayRequestTest extends TestCase
{
    /** @dataProvider getTypeProvider */
    public function testGetType(ParamRequest $expected, ArrayRequest $request): void
    {
        self::assertSame($expected, $request->getType());
    }

    public function getTypeProvider(): \Generator
    {
        $type = IntRequest::create();
        yield [
            'expected' => $type,
            ArrayRequest::create($type, 10)
        ];

        $type = StringRequest::create();
        yield [
            'expected' => $type,
            ArrayRequest::create($type, 10)
        ];
    }

    /** @dataProvider getCountOfEntriesProvider */
    public function testGetCountOfEntries(int $expected, ArrayRequest $request): void
    {
        self::assertSame($expected, $request->getCountOfEntries());
    }

    public function getCountOfEntriesProvider(): \Generator
    {
        yield [
            'expected' => 10,
            ArrayRequest::create(IntRequest::create(), 10)
        ];

        yield [
            'expected' => 7,
            ArrayRequest::create(IntRequest::create(), 7)
        ];
    }
}