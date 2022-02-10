<?php
declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Functional;

use LeoVie\PhpParamGenerator\Service\ParamGeneratorService;
use PHPUnit\Framework\TestCase;

class FrameworkTest extends TestCase
{
    public function testServiceWiring(): void
    {
        $kernel = new TestingKernel('test', true);
        $kernel->boot();
        $paramGeneratorService = $kernel->getContainer()->get(ParamGeneratorService::class);

        self::assertInstanceOf(ParamGeneratorService::class, $paramGeneratorService);
    }
}