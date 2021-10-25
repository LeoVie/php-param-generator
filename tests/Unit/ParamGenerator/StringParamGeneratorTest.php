<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\ParamGenerator;

use Faker\Generator as FakerGenerator;
use Generator;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\StringParamGenerator;
use PHPUnit\Framework\TestCase;

class StringParamGeneratorTest extends TestCase
{
    /** @dataProvider generateProvider */
    public function testGenerate(Param $expected, StringRequest $request, FakerGenerator $fakerGenerator): void
    {
        self::assertEquals($expected, (new StringParamGenerator($fakerGenerator))->generate($request));
    }

    public function generateProvider(): Generator
    {
        $fakerGenerator = $this->createMock(FakerGenerator::class);
        $fakerGenerator->method('__call')->with('text')->willReturn('abc def');
        yield 'StringRequest (#1)' => [
            'expected' => StringParam::create('abc def'),
            'request' => StringRequest::create(),
            $fakerGenerator,
        ];

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        $fakerGenerator->method('__call')->with('text')->willReturn('blabla!');
        yield 'StringRequest (#2)' => [
            'expected' => StringParam::create('blabla!'),
            'request' => StringRequest::create(),
            $fakerGenerator,
        ];
    }
}