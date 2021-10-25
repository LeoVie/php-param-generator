<?php
declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Exception;

use LeoVie\PhpParamGenerator\Exception\NoParamGeneratorFoundForParamRequest;
use PHPUnit\Framework\TestCase;

class NoParamGeneratorFoundForParamRequestTest extends TestCase
{
    public function testCreate(): void
    {
        self::assertSame(
            'No ParamGenerator found for Foo\\Bar',
            NoParamGeneratorFoundForParamRequest::create('Foo\\Bar')->getMessage()
        );
    }
}