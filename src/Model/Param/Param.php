<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\Param;

interface Param
{
    /** @param mixed $value */
    public static function create($value): self;

    /** @return mixed */
    public function getValue();

    /** @return mixed */
    public function flatten();
}