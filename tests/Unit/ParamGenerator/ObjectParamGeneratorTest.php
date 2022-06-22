<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\ParamGenerator;

require_once __DIR__ . '/../../testdata/bootstrap_script.php';

use Faker\Generator as FakerGenerator;
use Generator;
use LeoVie\PhpParamGenerator\Model\Param\ArrayParam;
use LeoVie\PhpParamGenerator\Model\Param\BoolParam;
use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\ObjectParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ArrayRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\BoolRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ObjectRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\ArrayParamGenerator;
use LeoVie\PhpParamGenerator\ParamGenerator\BoolParamGenerator;
use LeoVie\PhpParamGenerator\ParamGenerator\ObjectParamGenerator;
use LeoVie\PhpParamGenerator\ParamGenerator\ParamGeneratorFinderInterface;
use LeoVie\PhpParamGenerator\Tests\TestDouble\ParamGenerator\ParamGeneratorDouble;
use LeoVie\PhpParamGenerator\Tests\TestDouble\ParamGenerator\ParamGeneratorFinderDouble;
use PHPUnit\Framework\TestCase;

class ObjectParamGeneratorTest extends TestCase
{
    /** @dataProvider supportsProvider */
    public function testSupports(bool $expected, ParamRequest $paramRequest): void
    {
        $objectParamGenerator = new ObjectParamGenerator(
            $this->createMock(ParamGeneratorFinderInterface::class)
        );

        self::assertSame($expected, $objectParamGenerator->supports($paramRequest));
    }

    public function supportsProvider(): array
    {
        /** @var class-string $classFqn */
        $classFqn = '';

        return [
            'supported' => [
                'expected' => true,
                'paramRequest' => ObjectRequest::create('', $classFqn, []),
            ],
            'unsupported' => [
                'expected' => false,
                'paramRequest' => StringRequest::create(),
            ],
        ];
    }

    /** @dataProvider generateProvider */
    public function testGenerate(
        object          $expected,
        ObjectRequest    $request,
        array $paramGenerators
    ): void
    {
        $paramGeneratorFinder = new ParamGeneratorFinderDouble($paramGenerators);

        self::assertEquals($expected, (new ObjectParamGenerator($paramGeneratorFinder))->generate($request, 2));
    }

    public function generateProvider(): Generator
    {
        $boostrapScriptPath = __DIR__ . '/../../testdata/bootstrap_script.php';

        $params = [
            IntParam::create(10),
            StringParam::create('def'),
        ];
        yield [
            'expected' => ObjectParam::create(new \DTO(10, 'def')),
            'request' => ObjectRequest::create($boostrapScriptPath, \DTO::class, [IntRequest::create(), StringRequest::create()]),
            'paramGenerators' => [
                IntRequest::class => new ParamGeneratorDouble($params),
                StringRequest::class => new ParamGeneratorDouble([$params[1]]),
            ],
        ];
    }
}