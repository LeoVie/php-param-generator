<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\ParamGenerator;

use Faker\Generator as FakerGenerator;
use Generator;
use LeoVie\PhpParamGenerator\Configuration\EdgeCaseConfiguration;
use LeoVie\PhpParamGenerator\Configuration\EdgeCaseConfigurationInterface;
use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\StringParamGenerator;
use LeoVie\PhpParamGenerator\Tests\TestDouble\Configuration\EdgeCaseConfigurationDouble;
use PHPUnit\Framework\TestCase;

class StringParamGeneratorTest extends TestCase
{
    /** @dataProvider generateProvider */
    public function testGenerate(
        Param                          $expected,
        StringRequest                  $request,
        FakerGenerator                 $fakerGenerator,
        EdgeCaseConfigurationInterface $edgeCaseConfiguration,
        int                            $index
    ): void
    {
        self::assertEquals($expected, (new StringParamGenerator($fakerGenerator, $edgeCaseConfiguration))->generate($request, $index));
    }

    public function generateProvider(): Generator
    {
        $edgeCases = [
            1 => StringParam::create(''),
            2 => StringParam::create('long_string'),
        ];
        $edgeCaseConfiguration = new EdgeCaseConfigurationDouble($edgeCases);

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        $fakerGenerator->method('__call')->with('text')->willReturn('abc def');
        yield 'StringRequest (index 0)' => [
            'expected' => StringParam::create('abc def'),
            'request' => StringRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 0,
        ];

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        yield 'StringRequest (index 1)' => [
            'expected' => $edgeCases[1],
            'request' => StringRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 1,
        ];

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        yield 'StringRequest (index 2)' => [
            'expected' => $edgeCases[2],
            'request' => StringRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 2,
        ];

        $fakerGenerator = $this->createMock(FakerGenerator::class);
        $fakerGenerator->method('__call')->with('text')->willReturn('bla foo!');
        yield 'StringRequest (index 3)' => [
            'expected' => StringParam::create('bla foo!'),
            'request' => StringRequest::create(),
            $fakerGenerator,
            $edgeCaseConfiguration,
            'index' => 3,
        ];
    }
}