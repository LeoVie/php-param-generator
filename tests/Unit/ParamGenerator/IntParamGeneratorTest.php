<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\ParamGenerator;

use Faker\Generator as FakerGenerator;
use Generator;
use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ArrayRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\IntParamGenerator;
use PHPUnit\Framework\TestCase;

class IntParamGeneratorTest extends TestCase
{
    /** @dataProvider supportsProvider */
    public function testSupports(bool $expected, ParamRequest $paramRequest): void
    {
        $intParamGenerator = new IntParamGenerator(
            $this->createMock(FakerGenerator::class)
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
                'paramRequest' => ArrayRequest::create(IntRequest::create(), 10),
            ],
        ];
    }

    /** @dataProvider generateProvider */
    public function testGenerate(Param $expected, IntRequest $request, FakerGenerator $fakerGenerator): void
    {
        self::assertEquals($expected, (new IntParamGenerator($fakerGenerator))->generate($request));
    }

    public function generateProvider(): Generator
    {
        $fakerGenerator = $this->createMock(FakerGenerator::class);
        $fakerGenerator->method('randomNumber')->willReturn(10);
        yield 'IntRequest (#1)' => [
            'expected' => IntParam::create(10),
            'request' => IntRequest::create(),
            $fakerGenerator,
        ];

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        $fakerGenerator->method('randomNumber')->willReturn(983);
        yield 'IntRequest (#2)' => [
            'expected' => IntParam::create(983),
            'request' => IntRequest::create(),
            $fakerGenerator,
        ];
    }
}