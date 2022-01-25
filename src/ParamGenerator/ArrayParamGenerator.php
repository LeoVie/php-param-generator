<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\ParamGenerator;

use LeoVie\PhpParamGenerator\Exception\NoParamGeneratorFoundForParamRequest;
use LeoVie\PhpParamGenerator\Model\Param\ArrayParam;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ArrayRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;

class ArrayParamGenerator implements ParamGenerator
{
    private const SUPPORTED_REQUEST = ArrayRequest::class;

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
        /** @var ArrayRequest $arrayRequest */
        $arrayRequest = $request;

        return $this->generateArray($arrayRequest);
    }

    /** @throws NoParamGeneratorFoundForParamRequest */
    private function generateArray(ArrayRequest $request): ArrayParam
    {
        $values = [];
        foreach ($request->getTypes() as $index => $type) {
            $values[] = $this->paramGeneratorFinder
                ->getConcreteParamGenerator($type)
                ->generate($type, $index);
        }

        return ArrayParam::create($values);
    }
}