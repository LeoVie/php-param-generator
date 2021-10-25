<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\ParamGenerator;

use Faker\Generator as FakerGenerator;
use Generator;
use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\IntParamGenerator;
use PHPUnit\Framework\TestCase;

class IntParamGeneratorTest extends TestCase
{
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