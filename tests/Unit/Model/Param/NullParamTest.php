<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\Param;

use LeoVie\PhpParamGenerator\Model\Param\NullParam;
use PHPUnit\Framework\TestCase;

class NullParamTest extends TestCase
{
    public function testGetValue(): void
    {
        self::assertSame(null, NullParam::create()->getValue());
    }

    public function testFlatten(): void
    {
        self::assertSame(null, NullParam::create()->flatten());
    }
}