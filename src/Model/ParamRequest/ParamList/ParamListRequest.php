<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\ParamRequest\ParamList;

use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;

class ParamListRequest implements \Stringable
{
    /** @param ParamRequest[] $paramRequests */
    private function __construct(private array $paramRequests)
    {
    }

    /** @param ParamRequest[] $paramRequests */
    public static function create(array $paramRequests): self
    {
        return new self($paramRequests);
    }

    /** @return ParamRequest[] */
    public function getParamRequests(): array
    {
        return $this->paramRequests;
    }

    public function __toString(): string
    {
        return \Safe\sprintf('PARAM_LIST_REQUEST(%s)', join(', ', $this->getParamRequests()));
    }
}