<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\ParamRequest;

/** @psalm-immutable */
class ArrayRequest implements ParamRequest
{
    /** @param array<int, ParamRequest> $types */
    private function __construct(private array $types)
    {}

    /** @param array<int, ParamRequest> $types */
    public static function create(array $types): self
    {
        return new self($types);
    }

    /** @return array<int, ParamRequest> */
    public function getTypes(): array
    {
        return $this->types;
    }
}