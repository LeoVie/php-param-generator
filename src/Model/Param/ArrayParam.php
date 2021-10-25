<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\Param;

// TODO: Add generic template https://phpstan.org/blog/generics-in-php-using-phpdocs
class ArrayParam implements Param
{
    /** @param Param[] $value */
    private function __construct(private array $value)
    {
    }

    /** @param Param[] $value */
    public static function create($value): self
    {
        return new self($value);
    }

    /** @return Param[] */
    public function getValue(): array
    {
        return $this->value;
    }

    /** @return mixed[] */
    public function flatten(): array
    {
        return array_map(fn(Param $p): mixed => $p->flatten(), $this->getValue());
    }
}