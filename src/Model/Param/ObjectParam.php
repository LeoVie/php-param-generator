<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\Param;

class ObjectParam implements Param
{
    private function __construct(private object $value)
    {
    }

    /** @param object $value */
    public static function create($value): self
    {
        return new self($value);
    }

    public function getValue(): object
    {
        return $this->value;
    }

    public function flatten(): string
    {
        return serialize($this->getValue());
    }

    public function hash(): string
    {
        return sprintf('OBJECT_PARAM(%s)', $this->flatten());
    }
}