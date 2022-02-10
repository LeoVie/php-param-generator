<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\ParamRequest;

use LeoVie\PhpParamGenerator\Model\ParamRequest\FloatRequest;
use PHPUnit\Framework\TestCase;

class FloatRequestTest extends TestCase
{
    public function testCreate(): void
    {
        self::assertInstanceOf(FloatRequest::class, FloatRequest::create());
    }

    public function testToString(): void
    {
        self::assertSame('FLOAT_REQUEST', FloatRequest::create()->__toString());
    }
}