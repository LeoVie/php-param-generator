<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Service;

use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\ParamList\ParamList;
use LeoVie\PhpParamGenerator\Model\Param\ParamList\ParamListSet;
use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamList\ParamListRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamList\ParamListSetRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\ParamGeneratorFinderInterface;
use LeoVie\PhpParamGenerator\Service\ParamGeneratorService;
use LeoVie\PhpParamGenerator\Tests\TestDouble\ParamGenerator\ParamGeneratorDouble;
use LeoVie\PhpParamGenerator\Tests\TestDouble\ParamGenerator\ParamGeneratorFinderDouble;
use PHPUnit\Framework\TestCase;

class ParamGeneratorServiceTest extends TestCase
{
    /** @dataProvider generateProvider */
    public function testGenerate(
        ParamListSet                  $expected,
        ParamListSetRequest           $paramListSetRequest,
        ParamGeneratorFinderInterface $paramGeneratorFinder
    ): void
    {
        self::assertEquals($expected, (new ParamGeneratorService($paramGeneratorFinder))->generate($paramListSetRequest));
    }

    public function generateProvider(): \Generator
    {
        $params = [
            IntParam::create(10),
            IntParam::create(20),
        ];
        $expected = ParamListSet::create([
            ParamList::create([$params[0], $params[1]]),
        ]);
        $paramListSetRequest = ParamListSetRequest::create(
            ParamListRequest::create([
                IntRequest::create(),
                IntRequest::create(),
            ]),
            1
        );
        $paramGeneratorFinder = new ParamGeneratorFinderDouble([
            IntRequest::class => new ParamGeneratorDouble($params),
        ]);
        yield [
            'expected' => $expected,
            'paramListSetRequest' => $paramListSetRequest,
            'paramGeneratorFinder' => $paramGeneratorFinder,
        ];






        $params = [
            IntParam::create(10),
            IntParam::create(20),
        ];
        $expected = ParamListSet::create([
            ParamList::create([$params[0], $params[1]]),
        ]);
        $paramListSetRequest = ParamListSetRequest::create(
            ParamListRequest::create([
                IntRequest::create(),
                IntRequest::create(),
            ]),
            1
        );
        $paramGeneratorFinder = new ParamGeneratorFinderDouble([
            IntRequest::class => new ParamGeneratorDouble($params),
        ]);
        yield [
            'expected' => $expected,
            'paramListSetRequest' => $paramListSetRequest,
            'paramGeneratorFinder' => $paramGeneratorFinder,
        ];



        $params = [
            IntParam::create(10),
            StringParam::create('abc'),
            IntParam::create(20),
            StringParam::create('def'),
            IntParam::create(30),
            StringParam::create('ghi')
        ];
        $expected = ParamListSet::create([
            ParamList::create([$params[0], $params[1]]),
            ParamList::create([$params[2], $params[3]]),
            ParamList::create([$params[4], $params[5]]),
        ]);
        $paramListSetRequest = ParamListSetRequest::create(
            ParamListRequest::create([
                IntRequest::create(),
                StringRequest::create(),
            ]),
            3
        );
        $paramGeneratorFinder = new ParamGeneratorFinderDouble([
            IntRequest::class => new ParamGeneratorDouble([$params[0], $params[2], $params[4]]),
            StringRequest::class => new ParamGeneratorDouble([$params[1], $params[3], $params[5]]),
        ]);
        yield [
            'expected' => $expected,
            'paramListSetRequest' => $paramListSetRequest,
            'paramGeneratorFinder' => $paramGeneratorFinder,
        ];
    }
}