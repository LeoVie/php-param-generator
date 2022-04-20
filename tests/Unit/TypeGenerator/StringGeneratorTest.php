<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\TypeGenerator;

use Faker\Generator as FakerGenerator;
use LeoVie\PhpParamGenerator\Random\Coin;
use LeoVie\PhpParamGenerator\TypeGenerator\StringGenerator;
use PHPUnit\Framework\TestCase;

class StringGeneratorTest extends TestCase
{
    public function testGenerate(): void
    {
        $fakerGenerator = $this->createMock(FakerGenerator::class);
        $fakerGenerator->method('__call')->with('text')->willReturn('');

        $coin = $this->createMock(Coin::class);
        $coin->method('flip')->willReturnOnConsecutiveCalls(true, false);

        $stringGenerator = new StringGenerator($fakerGenerator, $coin);
        $randomString = $stringGenerator->generate();

        foreach (mb_str_split($randomString) as $char) {
            if ($char === ' ' || $char === '') {
                continue;
            }

            self::assertContains($char, StringGenerator::SPECIAL_CHARS);
        }
    }
}