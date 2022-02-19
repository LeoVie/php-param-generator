<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\ParamRequest;

class ArrayRequest implements ParamRequest
{
    /** @param ParamRequest[] $types */
    private function __construct(private array $types)
    {}

    /** @param ParamRequest[] $types */
    public static function create(array $types): self
    {
        return new self($types);
    }

    /** @return ParamRequest[] */
    public function getTypes(): array
    {
        return $this->types;
    }
}