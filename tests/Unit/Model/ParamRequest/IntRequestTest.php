<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\ParamRequest;

use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use PHPUnit\Framework\TestCase;

class IntRequestTest extends TestCase
{
    public function testCreate(): void
    {
        self::assertInstanceOf(IntRequest::class, IntRequest::create());
    }
}