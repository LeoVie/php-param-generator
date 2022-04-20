<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\TypeGenerator;

use Faker\Generator as FakerGenerator;
use LeoVie\PhpParamGenerator\Random\Coin;

class StringGenerator
{
    public const SPECIAL_CHARS = [
        "\n", "\r", "\t",
    ];

    public function __construct(
        private FakerGenerator $generator,
        private Coin           $coin,
    )
    {
    }

    public function generate(): string
    {
        $randomString = $this->generator->text();
        $randomString = $this->insertSpecialChars($randomString);
        $randomString = $this->randomlyAddSpacesAndBeginAndEnd($randomString);

        return $randomString;
    }

    private function insertSpecialChars(string $randomString): string
    {
        for ($i = 0; $i < 10; $i++) {
            $position = $this->pickRandomPosition($randomString);

            $character = $this->pickRandomSpecialChar();

            $stringPartitions = $this->stringPartition($randomString, $position);
            $randomString = join("", [$stringPartitions[0], $character, $stringPartitions[1]]);
        }

        return $randomString;
    }

    /** @return array{0: string, 1: string} */
    private function stringPartition(string $string, int $splitPosition): array
    {
        return [
            substr($string, 0, $splitPosition),
            substr($string, $splitPosition),
        ];
    }

    private function randomlyAddSpacesAndBeginAndEnd(string $randomString): string
    {
        if ($this->coin->flip()) {
            $randomString = ' ' . $randomString;
        }

        if ($this->coin->flip()) {
            $randomString = $randomString . ' ';
        }
        return $randomString;
    }

    private function pickRandomPosition(string $randomString): int
    {
        return rand(0, strlen($randomString) - 1);
    }

    private function pickRandomSpecialChar(): string
    {
        return self::SPECIAL_CHARS[rand(0, count(self::SPECIAL_CHARS) - 1)];
    }
}