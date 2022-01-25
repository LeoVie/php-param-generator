<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\ParamGenerator;

use LeoVie\PhpParamGenerator\Exception\NoParamGeneratorFoundForParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\ArrayParamGenerator;
use LeoVie\PhpParamGenerator\ParamGenerator\ParamGenerator;
use LeoVie\PhpParamGenerator\ParamGenerator\ParamGeneratorFinder;
use PHPUnit\Framework\TestCase;

class ParamGeneratorStrategyTest extends TestCase
{
    /**
     * @param ParamGenerator[] $paramGenerators
     *
     * @dataProvider getConcreteParamGeneratorProvider
     */
    public function testGetConcreteParamGenerator(ParamGenerator $expected, array $paramGenerators, ParamRequest $request): void
    {
        self::assertSame(
            $expected,
            (new ParamGeneratorFinder(new \ArrayIterator($paramGenerators)))->getConcreteParamGenerator($request)
        );
    }

    public function getConcreteParamGeneratorProvider(): array
    {
        $intParamGenerator = $this->createMock(ArrayParamGenerator::class);
        $intParamGenerator->method('supports')->willReturnCallback(fn(ParamRequest $p): bool => $p::class === IntRequest::class);

        $stringParamGenerator = $this->createMock(ArrayParamGenerator::class);
        $stringParamGenerator->method('supports')->willReturnCallback(fn(ParamRequest $p): bool => $p::class === StringRequest::class);

        $paramGenerators = [
            $intParamGenerator,
            $stringParamGenerator,
        ];

        return [
            [
                'expected' => $intParamGenerator,
                'paramGenerators' => $paramGenerators,
                'request' => IntRequest::create(),
            ],
            [
                'expected' => $stringParamGenerator,
                'paramGenerators' => $paramGenerators,
                'request' => StringRequest::create(),
            ],
        ];
    }

    /**
     * @param ParamGenerator[] $paramGenerators
     *
     * @dataProvider getConcreteParamsGeneratorThrowsProvider
     */
    public function testGetConcreteParamsGeneratorThrows(array $paramGenerators, ParamRequest $request): void
    {
        self::expectException(NoParamGeneratorFoundForParamRequest::class);

        (new ParamGeneratorFinder(new \ArrayIterator($paramGenerators)))->getConcreteParamGenerator($request);
    }

    public function getConcreteParamsGeneratorThrowsProvider(): \Generator
    {
        yield 'no paramGenerators' => [
            'paramGenerators' => [],
            IntRequest::create(),
        ];

        $intParamGenerator = $this->createMock(ArrayParamGenerator::class);
        $intParamGenerator->method('supports')->willReturnCallback(fn(ParamRequest $p): bool => $p::class === IntRequest::class);

        $paramGenerators = [
            $intParamGenerator,
        ];
        yield 'paramGenerator not in supported paramGenerators' => [
            'paramGenerators' => $paramGenerators,
            StringRequest::create(),
        ];
    }
}