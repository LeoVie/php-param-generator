<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\ParamGenerator;

use Generator;
use LeoVie\PhpParamGenerator\Model\Param\NullParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\NullRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\NullParamGenerator;
use PHPUnit\Framework\TestCase;

class NullParamGeneratorTest extends TestCase
{
    /** @dataProvider supportsProvider */
    public function testSupports(bool $expected, ParamRequest $paramRequest): void
    {
        $nullParamGenerator = new NullParamGenerator();

        self::assertSame($expected, $nullParamGenerator->supports($paramRequest));
    }

    public function supportsProvider(): array
    {
        return [
            'supported' => [
                'expected' => true,
                'paramRequest' => NullRequest::create(),
            ],
            'unsupported' => [
                'expected' => false,
                'paramRequest' => StringRequest::create(),
            ],
        ];
    }

    /** @dataProvider generateProvider */
    public function testGenerate(
        Param       $expected,
        NullRequest $request,
        int         $index
    ): void
    {
        self::assertEquals(
            $expected,
            (new NullParamGenerator())
                ->generate($request, $index)
        );
    }

    public function generateProvider(): Generator
    {
        yield 'NullRequest (index 0)' => [
            'expected' => NullParam::create(),
            'request' => NullRequest::create(),
            'index' => 0,
        ];
    }
}