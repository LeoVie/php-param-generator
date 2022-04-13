<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\ParamGenerator;

use Faker\Generator as FakerGenerator;
use Generator;
use LeoVie\PhpParamGenerator\Model\Param\BoolParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\BoolRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\BoolParamGenerator;
use PHPUnit\Framework\TestCase;

class BoolParamGeneratorTest extends TestCase
{
    /** @dataProvider supportsProvider */
    public function testSupports(bool $expected, ParamRequest $paramRequest): void
    {
        $boolParamGenerator = new BoolParamGenerator(
            $this->createMock(FakerGenerator::class)
        );

        self::assertSame($expected, $boolParamGenerator->supports($paramRequest));
    }

    public function supportsProvider(): array
    {
        return [
            'supported' => [
                'expected' => true,
                'paramRequest' => BoolRequest::create(),
            ],
            'unsupported' => [
                'expected' => false,
                'paramRequest' => StringRequest::create(),
            ],
        ];
    }

    /** @dataProvider generateProvider */
    public function testGenerate(
        Param          $expected,
        BoolRequest    $request,
        FakerGenerator $fakerGenerator,
        int            $index
    ): void
    {
        self::assertEquals(
            $expected,
            (new BoolParamGenerator($fakerGenerator))
                ->generate($request, $index)
        );
    }

    public function generateProvider(): Generator
    {
        $fakerGenerator = $this->getMockBuilder(FakerGenerator::class)->addMethods(['boolean'])->getMock();
        $fakerGenerator->method('boolean')->willReturn(true);
        yield 'BoolRequest (index 0)' => [
            'expected' => BoolParam::create(true),
            'request' => BoolRequest::create(),
            $fakerGenerator,
            'index' => 0,
        ];

        $fakerGenerator = $this->getMockBuilder(FakerGenerator::class)->addMethods(['boolean'])->getMock();
        $fakerGenerator->method('boolean')->willReturn(false);
        yield 'BoolRequest (index 1)' => [
            'expected' => BoolParam::create(false),
            'request' => BoolRequest::create(),
            $fakerGenerator,
            'index' => 1,
        ];
    }
}