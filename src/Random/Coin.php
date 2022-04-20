<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Random;

class Coin
{
    public function flip(): bool
    {
        return rand(0, 1) === 0;
    }
}