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
use LeoVie\PhpParamGenerator\ParamGenerator\ParamGeneratorFinderInterface;
use LeoVie\PhpParamGenerator\Tests\TestDouble\ParamGenerator\ParamGeneratorDouble;
use LeoVie\PhpParamGenerator\Tests\TestDouble\ParamGenerator\ParamGeneratorFinderDouble;
use PHPUnit\Framework\TestCase;

class ArrayParamGeneratorTest extends TestCase
{
    /** @dataProvider supportsProvider */
    public function testSupports(bool $expected, ParamRequest $paramRequest): void
    {
        $arrayParamGenerator = new ArrayParamGenerator(
            $this->createMock(ParamGeneratorFinderInterface::class)
        );

        self::assertSame($expected, $arrayParamGenerator->supports($paramRequest));
    }

    public function supportsProvider(): array
    {
        return [
            'supported' => [
                'expected' => true,
                'paramRequest' => ArrayRequest::create([IntRequest::create()]),
            ],
            'unsupported' => [
                'expected' => false,
                'paramRequest' => IntRequest::create(),
            ],
        ];
    }

    /** @dataProvider generateProvider */
    public function testGenerate(Param $expected, ArrayRequest $request, array $paramGenerators): void
    {
        $paramGeneratorFinder = new ParamGeneratorFinderDouble($paramGenerators);

        self::assertEquals($expected, (new ArrayParamGenerator($paramGeneratorFinder))->generate($request, 2));
    }

    public function generateProvider(): Generator
    {
        $params = [
            IntParam::create(10),
            IntParam::create(983),
        ];
        yield 'ArrayRequest<Int, Int> (#1)' => [
            'expected' => ArrayParam::create($params),
            'request' => ArrayRequest::create([IntRequest::create(), IntRequest::create()]),
            'paramGenerators' => [
                IntRequest::class => new ParamGeneratorDouble($params),
            ],
        ];

        $params = [
            IntParam::create(10),
            IntParam::create(983),
            IntParam::create(8000),
            IntParam::create(983),
        ];
        yield 'ArrayRequest<Int, Int> (#2)' => [
            'expected' => ArrayParam::create([$params[0], $params[1]]),
            'request' => ArrayRequest::create([IntRequest::create(), IntRequest::create()]),
            'paramGenerators' => [
                IntRequest::class => new ParamGeneratorDouble($params),
            ],
        ];

        $params = [
            StringParam::create('abc'),
            StringParam::create('def'),
        ];
        yield 'ArrayRequest<String, String> (#1)' => [
            'expected' => ArrayParam::create($params),
            'request' => ArrayRequest::create([StringRequest::create(), StringRequest::create()]),
            'paramGenerators' => [
                StringRequest::class => new ParamGeneratorDouble($params),
            ],
        ];

        $params = [
            IntParam::create(10),
            StringParam::create('def'),
        ];
        yield 'ArrayRequest<Int, String>' => [
            'expected' => ArrayParam::create($params),
            'request' => ArrayRequest::create([IntRequest::create(), StringRequest::create()]),
            'paramGenerators' => [
                IntRequest::class => new ParamGeneratorDouble([$params[0]]),
                StringRequest::class => new ParamGeneratorDouble([$params[1]]),
            ],
        ];
    }
}