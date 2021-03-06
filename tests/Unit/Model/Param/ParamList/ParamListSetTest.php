<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\Param\ParamList;

use LeoVie\PhpParamGenerator\Model\Param\IntParam;
use LeoVie\PhpParamGenerator\Model\Param\ParamList\ParamList;
use LeoVie\PhpParamGenerator\Model\Param\ParamList\ParamListSet;
use LeoVie\PhpParamGenerator\Model\Param\StringParam;
use PHPUnit\Framework\TestCase;

class ParamListSetTest extends TestCase
{
    /** @dataProvider getParamListsProvider */
    public function testGetParamLists(array $expected, ParamListSet $paramList): void
    {
        self::assertSame($expected, $paramList->getParamLists());
    }

    public function getParamListsProvider(): \Generator
    {
        $paramLists = [
            ParamList::create([IntParam::create(10)])
        ];
        yield [
            'expected' => $paramLists,
            'paramList' => ParamListSet::create($paramLists),
        ];

        $paramLists = [
            ParamList::create([IntParam::create(10)]),
            ParamList::create([StringParam::create('abc')])
        ];
        yield [
            'expected' => $paramLists,
            'paramList' => ParamListSet::create($paramLists),
        ];
    }
}