<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\ParamGenerator;

use Generator;
use LeoVie\PhpParamGenerator\Configuration\EdgeCaseConfigurationInterface;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\StringParamGenerator;
use LeoVie\PhpParamGenerator\Tests\TestDouble\Configuration\EdgeCaseConfigurationDouble;
use LeoVie\PhpParamGenerator\TypeGenerator\StringGenerator;
use PHPUnit\Framework\TestCase;

class StringParamGeneratorTest extends TestCase
{
    /** @dataProvider supportsProvider */
    public function testSupports(bool $expected, ParamRequest $paramRequest): void
    {
        $intParamGenerator = new StringParamGenerator(
            $this->createMock(StringGenerator::class),
            $this->createMock(EdgeCaseConfigurationInterface::class),
        );

        self::assertSame($expected, $intParamGenerator->supports($paramRequest));
    }

    public function supportsProvider(): array
    {
        return [
            'supported' => [
                'expected' => true,
                'paramRequest' => StringRequest::create(),
            ],
            'unsupported' => [
                'expected' => false,
                'paramRequest' => IntRequest::create(),
            ],
        ];
    }

    /** @dataProvider generateProvider */
    public function testGenerate(
        Param                          $expected,
        StringRequest                  $request,
        StringGenerator                $stringGenerator,
        EdgeCaseConfigurationInterface $edgeCaseConfiguration,
        int                            $index
    ): void
    {
        self::assertEquals($expected, (new StringParamGenerator($stringGenerator, $edgeCaseConfiguration))->generate($request, $index));
    }

    public function generateProvider(): Generator
    {
        $edgeCases = [
            1 => StringParam::create(''),
            2 => StringParam::create('long_string'),
        ];
        $edgeCaseConfiguration = new EdgeCaseConfigurationDouble($edgeCases);

        $stringGenerator = $this->createMock(StringGenerator::class);
        $stringGenerator->method('generate')->willReturn('abc def');
        yield 'StringRequest (index 0)' => [
            'expected' => StringParam::create('abc def'),
            'request' => StringRequest::create(),
            $stringGenerator,
            $edgeCaseConfiguration,
            'index' => 0,
        ];

        $stringGenerator = $this->createMock(StringGenerator::class);
        yield 'StringRequest (index 1)' => [
            'expected' => $edgeCases[1],
            'request' => StringRequest::create(),
            $stringGenerator,
            $edgeCaseConfiguration,
            'index' => 1,
        ];

        $stringGenerator = $this->createMock(StringGenerator::class);
        yield 'StringRequest (index 2)' => [
            'expected' => $edgeCases[2],
            'request' => StringRequest::create(),
            $stringGenerator,
            $edgeCaseConfiguration,
            'index' => 2,
        ];

        $stringGenerator = $this->createMock(StringGenerator::class);
        $stringGenerator->method('generate')->willReturn('bla foo!');
        yield 'StringRequest (index 3)' => [
            'expected' => StringParam::create('bla foo!'),
            'request' => StringRequest::create(),
            $stringGenerator,
            $edgeCaseConfiguration,
            'index' => 3,
        ];
    }
}