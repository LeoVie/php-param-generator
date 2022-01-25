<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\ParamGenerator;

use Faker\Generator as FakerGenerator;
use Generator;
use LeoVie\PhpParamGenerator\Configuration\EdgeCaseConfigurationInterface;
use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\IntParamGenerator;
use LeoVie\PhpParamGenerator\Tests\TestDouble\Configuration\EdgeCaseConfigurationDouble;
use PHPUnit\Framework\TestCase;

class IntParamGeneratorTest extends TestCase
{
    /** @dataProvider supportsProvider */
    public function testSupports(bool $expected, ParamRequest $paramRequest): void
    {
        $intParamGenerator = new IntParamGenerator(
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
                'paramRequest' => IntRequest::create(),
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
        IntRequest                     $request,
        FakerGenerator                 $fakerGenerator,
        EdgeCaseConfigurationInterface $edgeCaseConfiguration,
        int                            $index
    ): void
    {
        self::assertEquals($expected, (new IntParamGenerator($fakerGenerator, $edgeCaseConfiguration))->generate($request, $index));
    }

    public function generateProvider(): Generator
    {
        $edgeCases = [
            1 => IntParam::create(0),
            2 => IntParam::create(PHP_INT_MAX),
            3 => IntParam::create(PHP_INT_MIN),
        ];
        $edgeCaseConfiguration = new EdgeCaseConfigurationDouble($edgeCases);

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        $fakerGenerator->method('randomNumber')->willReturn(10);
        yield 'IntRequest (index 0)' => [
            'expected' => IntParam::create(10),
            'request' => IntRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 0,
        ];

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        yield 'IntRequest (index 1)' => [
            'expected' => $edgeCases[1],
            'request' => IntRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 1,
        ];

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        yield 'IntRequest (index 2)' => [
            'expected' => $edgeCases[2],
            'request' => IntRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 2,
        ];

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        yield 'IntRequest (index 3)' => [
            'expected' => $edgeCases[3],
            'request' => IntRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 3,
        ];

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        $fakerGenerator->method('randomNumber')->willReturn(983);
        yield 'IntRequest (index 4)' => [
            'expected' => IntParam::create(983),
            'request' => IntRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 4,
        ];
    }
}