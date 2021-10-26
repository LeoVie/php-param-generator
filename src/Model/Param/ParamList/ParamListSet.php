<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\Param\ParamList;

class ParamListSet implements \Stringable
{
    /** @param ParamList[] $paramLists */
    private function __construct(private array $paramLists)
    {}

    /** @param ParamList[] $paramLists */
    public static function create(array $paramLists): self
    {
        return new self($paramLists);
    }

    /** @return ParamList[] */
    public function getParamLists(): array
    {
        return $this->paramLists;
    }

    public function __toString(): string
    {
        return \Safe\sprintf('PARAM_LIST_SET(%s)', join(', ', $this->getParamLists()));
    }
}