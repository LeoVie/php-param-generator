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
    public function generate(ParamRequest $request): Param
    {
        /** @var ArrayRequest $arrayRequest */
        $arrayRequest = $request;

        return $this->generateArray($arrayRequest);
    }

    /** @throws NoParamGeneratorFoundForParamRequest */
    private function generateArray(ArrayRequest $request): ArrayParam
    {
        $values = array_map(
            fn(ParamRequest $pr): Param => $this->paramGeneratorFinder
                ->getConcreteParamGenerator($pr)
                ->generate($pr),
            $request->getTypes()
        );

        return ArrayParam::create($values);
    }
}