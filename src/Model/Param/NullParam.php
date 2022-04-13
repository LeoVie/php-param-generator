<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\Param;

class NullParam implements Param
{
    private function __construct()
    {
    }

    /** @param null $value */
    public static function create($value = null): self
    {
        return new self();
    }

    /** @return null */
    public function getValue()
    {
        return null;
    }

    /** @return null */
    public function flatten()
    {
        return $this->getValue();
    }

    public function hash(): string
    {
        return \Safe\sprintf('NULL_PARAM()');
    }
}