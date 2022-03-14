<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\Param;

/** @psalm-immutable */
class FloatParam implements Param
{
    public const NUMBER_OF_DECIMALS = 8;

    private function __construct(private float $value)
    {
    }

    /** @param float $value */
    public static function create($value): self
    {
        return new self($value);
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function flatten(): float
    {
        return $this->getValue();
    }

    public function hash(): string
    {
        $flattenPattern = 'FLOAT_PARAM(%.' . self::NUMBER_OF_DECIMALS . 'F)';

        return \Safe\sprintf($flattenPattern, $this->flatten());
    }
}