<?php
declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Exception;

use LeoVie\PhpParamGenerator\Exception\NoEdgeCasesFoundForParamRequest;
use PHPUnit\Framework\TestCase;

class NoEdgeCasesFoundForParamRequestTest extends TestCase
{
    public function testCreate(): void
    {
        self::assertSame(
            'No edge cases found for ParamRequestClass',
            NoEdgeCasesFoundForParamRequest::create('ParamRequestClass')->getMessage()
        );
    }
}