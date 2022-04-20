<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Random;

class Coin
{
    private const HEADS = 0;
    private const TAILS = 1;

    public function flip(): bool
    {
        return (bool) rand(self::HEADS, self::TAILS);
    }
}