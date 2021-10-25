<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\ParamRequest;

class ArrayRequest implements ParamRequest
{
    private function __construct(private ParamRequest $type, private int $countOfEntries)
    {}

    public static function create(ParamRequest $type, int $countOfEntries): self
    {
        return new self($type, $countOfEntries);
    }

    public function getType(): ParamRequest
    {
        return $this->type;
    }

    public function getCountOfEntries(): int
    {
        return $this->countOfEntries;
    }
}