<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\ParamGenerator;

use Generator;
use LeoVie\PhpParamGenerator\Model\Param\ArrayParam;
use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ArrayRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\ArrayParamGenerator;
use LeoVie\PhpParamGenerator\ParamGenerator\IntParamGenerator;
use LeoVie\PhpParamGenerator\ParamGenerator\ParamGenerator;
use LeoVie\PhpParamGenerator\ParamGenerator\ParamGeneratorStrategy;
use LeoVie\PhpParamGenerator\ParamGenerator\StringParamGenerator;
use PHPUnit\Framework\TestCase;

class ArrayParamGeneratorTest extends TestCase
{
    /** @dataProvider supportsProvider */
    public function testSupports(bool $expected, ParamRequest $paramRequest): void
    {
        $arrayParamGenerator = new ArrayParamGenerator(
            $this->createMock(ParamGeneratorStrategy::class)
        );

        self::assertSame($expected, $arrayParamGenerator->supports($paramRequest));
    }

    public function supportsProvider(): array
    {
        return [
            'supported' => [
                'expected' => true,
                'paramRequest' => ArrayRequest::create(IntRequest::create(), 10),
            ],
            'unsupported' => [
                'expected' => false,
                'paramRequest' => IntRequest::create(),
            ],
        ];
    }

    /** @dataProvider generateProvider */
    public function testGenerate(Param $expected, ArrayRequest $request, ParamGenerator $paramGenerator): void
    {
        $paramGeneratorStrategy = $this->createMock(ParamGeneratorStrategy::class);
        $paramGeneratorStrategy->method('getConcreteParamGenerator')->willReturn($paramGenerator);

        self::assertEquals($expected, (new ArrayParamGenerator($paramGeneratorStrategy))->generate($request));
    }

    public function generateProvider(): Generator
    {
        $params = [
            IntParam::create(10),
            IntParam::create(983),
        ];
        $intParamGenerator = $this->createMock(IntParamGenerator::class);
        $intParamGenerator->method('generate')->willReturnOnConsecutiveCalls(...$params);
        yield 'ArrayRequest<Int> (#1)' => [
            'expected' => ArrayParam::create($params),
            'request' => ArrayRequest::create(IntRequest::create(), 2),
            $intParamGenerator,
        ];

        $params = [
            IntParam::create(10),
            IntParam::create(983),
            IntParam::create(8000),
            IntParam::create(983),
        ];
        $intParamGenerator = $this->createMock(IntParamGenerator::class);
        $intParamGenerator->method('generate')->willReturnOnConsecutiveCalls(...$params);
        yield 'ArrayRequest<Int> (#2)' => [
            'expected' => ArrayParam::create([$params[0], $params[1]]),
            'request' => ArrayRequest::create(IntRequest::create(), 2),
            $intParamGenerator,
        ];

        $params = [
            StringParam::create('abc'),
            StringParam::create('def'),
        ];
        $stringParamGenerator = $this->createMock(StringParamGenerator::class);
        $stringParamGenerator->method('generate')->willReturnOnConsecutiveCalls(...$params);
        yield 'ArrayRequest<String> (#1)' => [
            'expected' => ArrayParam::create($params),
            'request' => ArrayRequest::create(StringRequest::create(), 2),
            $stringParamGenerator,
        ];
    }
}