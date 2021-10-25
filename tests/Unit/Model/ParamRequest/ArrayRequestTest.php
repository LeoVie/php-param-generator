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
    public function testGetTypes(array $expected, ArrayRequest $request): void
    {
        self::assertSame($expected, $request->getTypes());
    }

    public function getTypeProvider(): \Generator
    {
        $types = [IntRequest::create(), IntRequest::create()];
        yield [
            'expected' => $types,
            ArrayRequest::create($types),
        ];

        $types = [StringRequest::create(), IntRequest::create(), StringRequest::create()];
        yield [
            'expected' => $types,
            ArrayRequest::create($types),
        ];
    }
}