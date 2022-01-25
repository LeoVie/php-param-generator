<?php
declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Functional;

use LeoVie\PhpParamGenerator\ParamGenerator\ParamGeneratorFinder;
use PHPUnit\Framework\TestCase;

class FrameworkTest extends TestCase
{
    public function testServiceWiring(): void
    {
        $kernel = new TestingKernel('test', true);
        $kernel->boot();
        $paramGeneratorFinder = $kernel->getContainer()->get(ParamGeneratorFinder::class);

        self::assertInstanceOf(ParamGeneratorFinder::class, $paramGeneratorFinder);
    }
}