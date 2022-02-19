<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\ParamRequest\ParamList;

/** @psalm-immutable */
class ParamListSetRequest
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
}