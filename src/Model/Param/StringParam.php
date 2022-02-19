<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\Param;

class StringParam implements Param
{
    private function __construct(private string $value)
    {
    }

    /** @param string $value */
    public static function create($value): self
    {
        return new self($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function flatten(): string
    {
        return $this->getValue();
    }
}