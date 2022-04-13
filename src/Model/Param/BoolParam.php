<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\Param;

/** @psalm-immutable */
class BoolParam implements Param
{
    private function __construct(private bool $value)
    {
    }

    /** @param bool $value */
    public static function create($value): self
    {
        return new self($value);
    }

    public function getValue(): bool
    {
        return $this->value;
    }

    public function flatten(): bool
    {
        return $this->getValue();
    }

    public function hash(): string
    {
        return \Safe\sprintf('BOOL_PARAM(%s)', $this->flatten() ? 'true' : 'false');
    }
}