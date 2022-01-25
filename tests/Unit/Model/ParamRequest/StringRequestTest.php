<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\ParamRequest;

use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use PHPUnit\Framework\TestCase;

class StringRequestTest extends TestCase
{
    public function testCreate(): void
    {
        self::assertInstanceOf(StringRequest::class, StringRequest::create());
    }

    public function testToString(): void
    {
        self::assertSame('STRING_REQUEST', StringRequest::create()->__toString());
    }
}