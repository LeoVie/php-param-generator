<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\Param\ParamList;

use LeoVie\PhpParamGenerator\Model\Param\Param;

class ParamList implements \Stringable
{
    /** @param Param[] $params */
    private function __construct(private array $params)
    {}

    /** @param Param[] $params */
    public static function create(array $params): self
    {
        return new self($params);
    }

    /** @return Param[] */
    public function getParams(): array
    {
        return $this->params;
    }

    public function __toString(): string
    {
        return \Safe\sprintf('PARAM_LIST(%s)', join(', ', $this->getParams()));
    }
}