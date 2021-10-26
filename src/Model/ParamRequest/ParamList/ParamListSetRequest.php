<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\ParamRequest\ParamList;

class ParamListSetRequest implements \Stringable
{
    private function __construct(private ParamListRequest $paramListRequest, private int $count)
    {
    }

    public static function create(ParamListRequest $paramListRequest, int $count): self
    {
        return new self($paramListRequest, $count);
    }

    public function getParamListRequest(): ParamListRequest
    {
        return $this->paramListRequest;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function __toString(): string
    {
        return \Safe\sprintf('PARAM_LIST_SET_REQUEST(%sx %s)', $this->getCount(), $this->getParamListRequest());
    }
}