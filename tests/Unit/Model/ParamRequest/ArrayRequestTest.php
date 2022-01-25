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
    public function testGetType(ParamRequest $type): void
    {
        self::assertSame($type, ArrayRequest::create($type, 10)->getType());
    }

    public function getTypeProvider(): array
    {
        return [
            [IntRequest::create()],
            [StringRequest::create()],
        ];
    }

    /** @dataProvider getCountOfEntriesProvider */
    public function testGetCountOfEntries(int $countOfEntries): void
    {
        self::assertSame(
            $countOfEntries,
            ArrayRequest::create(IntRequest::create(), $countOfEntries)->getCountOfEntries()
        );
    }

    public function getCountOfEntriesProvider(): array
    {
        return [
            [10],
            [7]
        ];
    }
}