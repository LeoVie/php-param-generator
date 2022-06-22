<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Model\ParamRequest;

/** @psalm-immutable */
class ObjectRequest implements ParamRequest
{
    /**
     * @param class-string $classFQN
     * @param array<int, ParamRequest> $constructorTypes
     */
    private function __construct(private string $bootstrapScriptPath, private string $classFQN, private array $constructorTypes)
    {
    }

    /**
     * @param class-string $classFQN
     * @param array<int, ParamRequest> $constructorTypes
     */
    public static function create(string $bootstrapScriptPath, string $classFQN, array $constructorTypes): self
    {
        return new self($bootstrapScriptPath, $classFQN, $constructorTypes);
    }

    public function getBootstrapScriptPath(): string
    {
        return $this->bootstrapScriptPath;
    }

    /** @return class-string */
    public function getClassFQN(): string
    {
        return $this->classFQN;
    }

    /** @return array<int, ParamRequest> */
    public function getConstructorTypes(): array
    {
        return $this->constructorTypes;
    }
}