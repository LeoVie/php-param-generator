<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\ParamRequest;

use LeoVie\PhpParamGenerator\Model\ParamRequest\BoolRequest;
use PHPUnit\Framework\TestCase;

class BoolRequestTest extends TestCase
{
    public function testCreate(): void
    {
        self::assertInstanceOf(BoolRequest::class, BoolRequest::create());
    }
}