<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\ParamRequest;

use LeoVie\PhpParamGenerator\Model\ParamRequest\ArrayRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use PHPUnit\Framework\TestCase;

class ArrayRequestTest extends TestCase
{
    /** @dataProvider getTypeProvider */
    public function testGetTypes(array $types): void
    {
        self::assertSame($types, ArrayRequest::create($types)->getTypes());
    }

    public function getTypeProvider(): array
    {
        return [
            [[IntRequest::create(), IntRequest::create()]],
            [[StringRequest::create(), IntRequest::create(), StringRequest::create()]]
        ];
    }

    /** @dataProvider toStringProvider */
    public function testToString(string $expected, ArrayRequest $request): void
    {
        self::assertSame($expected, $request->__toString());
    }

    public function toStringProvider(): \Generator
    {
        $types = [IntRequest::create(), IntRequest::create()];
        yield [
            'expected' => 'ARRAY_REQUEST(INT_REQUEST, INT_REQUEST)',
            ArrayRequest::create($types),
        ];

        $types = [StringRequest::create(), IntRequest::create(), StringRequest::create()];
        yield [
            'expected' => 'ARRAY_REQUEST(STRING_REQUEST, INT_REQUEST, STRING_REQUEST)',
            ArrayRequest::create($types),
        ];
    }
}