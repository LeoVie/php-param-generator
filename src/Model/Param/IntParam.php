<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\Param;

/** @psalm-immutable */
class IntParam implements Param
{
    private function __construct(private int $value)
    {
    }

    /** @param int $value */
    public static function create($value): self
    {
        return new self($value);
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function flatten(): int
    {
        return $this->getValue();
    }

    public function hash(): string
    {
        return \Safe\sprintf('INT_PARAM(%s)', $this->flatten());
    }
}