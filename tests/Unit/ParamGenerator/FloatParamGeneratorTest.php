<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\ParamGenerator;

use Faker\Generator as FakerGenerator;
use Generator;
use LeoVie\PhpParamGenerator\Configuration\EdgeCaseConfigurationInterface;
use LeoVie\PhpParamGenerator\Model\Param\FloatParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\FloatRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\FloatParamGenerator;
use LeoVie\PhpParamGenerator\Tests\TestDouble\Configuration\EdgeCaseConfigurationDouble;
use PHPUnit\Framework\TestCase;

class FloatParamGeneratorTest extends TestCase
{
    /** @dataProvider supportsProvider */
    public function testSupports(bool $expected, ParamRequest $paramRequest): void
    {
        $intParamGenerator = new FloatParamGenerator(
            $this->createMock(FakerGenerator::class),
            $this->createMock(EdgeCaseConfigurationInterface::class),
        );

        self::assertSame($expected, $intParamGenerator->supports($paramRequest));
    }

    public function supportsProvider(): array
    {
        return [
            'supported' => [
                'expected' => true,
                'paramRequest' => FloatRequest::create(),
            ],
            'unsupported' => [
                'expected' => false,
                'paramRequest' => StringRequest::create(),
            ],
        ];
    }

    /** @dataProvider generateProvider */
    public function testGenerate(
        Param                          $expected,
        FloatRequest                   $request,
        FakerGenerator                 $fakerGenerator,
        EdgeCaseConfigurationInterface $edgeCaseConfiguration,
        int                            $index
    ): void
    {
        self::assertEquals(
            $expected,
            (new FloatParamGenerator($fakerGenerator, $edgeCaseConfiguration))
                ->generate($request, $index)
        );
    }

    public function generateProvider(): Generator
    {
        $edgeCases = [
            1 => FloatParam::create(0),
            2 => FloatParam::create(PHP_FLOAT_MAX),
            3 => FloatParam::create(PHP_FLOAT_MIN),
        ];
        $edgeCaseConfiguration = new EdgeCaseConfigurationDouble($edgeCases);

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        $fakerGenerator->method('randomFloat')->willReturn(0.004);
        yield 'FloatRequest (index 0)' => [
            'expected' => FloatParam::create(0.004),
            'request' => FloatRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 0,
        ];

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        yield 'FloatRequest (index 1)' => [
            'expected' => $edgeCases[1],
            'request' => FloatRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 1,
        ];

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        yield 'FloatRequest (index 2)' => [
            'expected' => $edgeCases[2],
            'request' => FloatRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 2,
        ];

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        yield 'FloatRequest (index 3)' => [
            'expected' => $edgeCases[3],
            'request' => FloatRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 3,
        ];

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        $fakerGenerator->method('randomFloat')->willReturn(-33.09);
        yield 'IntRequest (index 4)' => [
            'FloatRequest' => FloatParam::create(-33.09),
            'request' => FloatRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 4,
        ];
    }
}