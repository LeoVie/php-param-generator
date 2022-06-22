<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\ParamGenerator;

use LeoVie\PhpParamGenerator\Exception\NoParamGeneratorFoundForParamRequest;
use LeoVie\PhpParamGenerator\Model\Param\ObjectParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ObjectRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;

class ObjectParamGenerator implements ParamGenerator
{
    private const SUPPORTED_REQUEST = ObjectRequest::class;

    public function __construct(private ParamGeneratorFinderInterface $paramGeneratorFinder)
    {
    }

    public function supports(ParamRequest $request): bool
    {
        return $request::class === self::SUPPORTED_REQUEST;
    }


    /** @throws NoParamGeneratorFoundForParamRequest */
    public function generate(ParamRequest $request, int $index): Param
    {
        /** @var ObjectRequest $objectRequest */
        $objectRequest = $request;

        return $this->generateObject($objectRequest);
    }

    /** @throws NoParamGeneratorFoundForParamRequest */
    private function generateObject(ObjectRequest $request): ObjectParam
    {
        $values = [];
        foreach ($request->getConstructorTypes() as $index => $type) {
            $values[] = $this->paramGeneratorFinder
                ->getConcreteParamGenerator($type)
                ->generate($type, $index);
        }

        require_once $request->getBootstrapScriptPath();

        $object = new ($request->getClassFQN())(...array_map(
            fn(Param $param) => $param->flatten(),
            $values
        ));

        return ObjectParam::create($object);
    }
}