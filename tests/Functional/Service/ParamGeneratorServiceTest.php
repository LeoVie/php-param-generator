<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Functional\Service;

use LeoVie\PhpParamGenerator\Model\Param\FloatParam;
use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use LeoVie\PhpParamGenerator\Model\ParamRequest\FloatRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamList\ParamListRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamList\ParamListSetRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use LeoVie\PhpParamGenerator\Service\ParamGeneratorService;
use LeoVie\PhpParamGenerator\Tests\Functional\TestingKernel;
use PHPUnit\Framework\TestCase;

class ParamGeneratorServiceTest extends TestCase
{
    private ParamGeneratorService $paramGeneratorService;

    protected function setUp(): void
    {
        $kernel = new TestingKernel('test', true);
        $kernel->boot();
        /** @var ParamGeneratorService $paramGeneratorService */
        $paramGeneratorService = $kernel->getContainer()->get(ParamGeneratorService::class);

        $this->paramGeneratorService = $paramGeneratorService;
    }

    /** @dataProvider generateProvider */
    public function testGenerate(
        int   $paramListSetRequestCount,
        array $paramRequests,
        array $paramInstanceExpectations,
        array $paramExpectations
    ): void
    {
        $paramListSet = $this->paramGeneratorService->generate(ParamListSetRequest::create(
            ParamListRequest::create($paramRequests),
            $paramListSetRequestCount
        ));

        $paramLists = $paramListSet->getParamLists();

        self::assertCount($paramListSetRequestCount, $paramLists);
        self::assertCount(count($paramRequests), $paramLists[0]->getParams());

        foreach ($paramInstanceExpectations as $paramListIndex => $paramInstanceExpectation) {
            foreach ($paramInstanceExpectation as $paramIndex => $expectedClass) {
                self::assertInstanceOf(
                    $expectedClass,
                    $paramLists[$paramListIndex]->getParams()[$paramIndex]
                );
            }
        }

        foreach ($paramExpectations as $paramListIndex => $paramExpectation) {
            foreach ($paramExpectation as $paramIndex => $param) {
                self::assertEquals(
                    $param,
                    $paramLists[$paramListIndex]->getParams()[$paramIndex]
                );
            }
        }
    }

    public function generateProvider(): array
    {
        return [
            0 => [
                'paramListSetRequestCount' => 4,
                'paramRequests' => [
                    IntRequest::create(),
                ],
                'paramInstanceExpectations' => [
                    0 => [
                        0 => IntParam::class,
                    ],
                ],
                'paramExpectations' => [
                    1 => [
                        0 => IntParam::create(0),
                    ],
                    2 => [
                        0 => IntParam::create(PHP_INT_MAX),
                    ],
                    3 => [
                        0 => IntParam::create(PHP_INT_MIN),
                    ],
                ],
            ],
            1 => [
                'paramListSetRequestCount' => 5,
                'paramRequests' => [
                    IntRequest::create(),
                ],
                'paramInstanceExpectations' => [
                    0 => [
                        0 => IntParam::class,
                    ],
                    4 => [
                        0 => IntParam::class,
                    ],
                ],
                'paramExpectations' => [],
            ],
            2 => [
                'paramListSetRequestCount' => 1,
                'paramRequests' => [
                    IntRequest::create(),
                    StringRequest::create(),
                ],
                'paramInstanceExpectations' => [
                    0 => [
                        0 => IntParam::class,
                        1 => StringParam::class,
                    ],
                ],
                'paramExpectations' => [],
            ],
            3 => [
                'paramListSetRequestCount' => 3,
                'paramRequests' => [
                    StringRequest::create(),
                ],
                'paramInstanceExpectations' => [
                    0 => [
                        0 => StringParam::class,
                    ],
                ],
                'paramExpectations' => [
                    1 => [
                        0 => StringParam::create(''),
                    ],
                    2 => [
                        0 => StringParam::create($this->longString()),
                    ],
                ],
            ],
            4 => [
                'paramListSetRequestCount' => 4,
                'paramRequests' => [
                    FloatRequest::create(),
                ],
                'paramInstanceExpectations' => [
                    0 => [
                        0 => FloatParam::class,
                    ],
                ],
                'paramExpectations' => [
                    1 => [
                        0 => FloatParam::create(0),
                    ],
                    2 => [
                        0 => FloatParam::create(PHP_FLOAT_MAX),
                    ],
                    3 => [
                        0 => FloatParam::create(PHP_FLOAT_MIN),
                    ],
                ],
            ],
            5 => [
                'paramListSetRequestCount' => 5,
                'paramRequests' => [
                    FloatRequest::create(),
                ],
                'paramInstanceExpectations' => [
                    0 => [
                        0 => FloatParam::class,
                    ],
                    4 => [
                        0 => FloatParam::class,
                    ],
                ],
                'paramExpectations' => [],
            ],
        ];
    }

    private function longString(): string
    {
        return \Safe\file_get_contents(__DIR__ . '/../../../pre_generated/long_string.txt');
    }
}