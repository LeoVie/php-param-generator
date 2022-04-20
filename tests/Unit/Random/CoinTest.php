<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Random;

use LeoVie\PhpParamGenerator\Random\Coin;
use PHPUnit\Framework\TestCase;

class CoinTest extends TestCase
{
    public function testFlip(): void
    {
        $results = [];
        for ($i = 0; $i < 1000; $i++) {
            $results[] = (new Coin())->flip();
        }

        $heads = array_filter($results, fn(bool $result): bool => $result === true);
        $percentageOfHeads = (count($heads) / count($results)) * 100;

        self::assertEqualsWithDelta(50, $percentageOfHeads, 5);
    }
}