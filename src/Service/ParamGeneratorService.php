<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Service;

use LeoVie\PhpParamGenerator\Exception\NoParamGeneratorFoundForParamRequest;
use LeoVie\PhpParamGenerator\Model\Param\Param;
use LeoVie\PhpParamGenerator\Model\Param\ParamList\ParamList;
use LeoVie\PhpParamGenerator\Model\Param\ParamList\ParamListSet;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamList\ParamListRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamList\ParamListSetRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ParamRequest;
use LeoVie\PhpParamGenerator\ParamGenerator\ParamGeneratorFinderInterface;

class ParamGeneratorService
{
    public function __construct(private ParamGeneratorFinderInterface $paramGeneratorFinder)
    {
    }

    /** @throws NoParamGeneratorFoundForParamRequest */
    public function generate(ParamListSetRequest $paramListSetRequest): ParamListSet
    {
        return $this->generateByParamListSetRequest($paramListSetRequest);
    }

    /** @throws NoParamGeneratorFoundForParamRequest */
    private function generateByParamListSetRequest(ParamListSetRequest $paramListSetRequest): ParamListSet
    {
        $paramLists = [];
        for ($i = 0; $i < $paramListSetRequest->getCount(); $i++) {
            $paramLists[] = $this->generateByParamListRequest($paramListSetRequest->getParamListRequest(), $i);
        }

        return ParamListSet::create($paramLists);
    }

    /** @throws NoParamGeneratorFoundForParamRequest */
    private function generateByParamListRequest(ParamListRequest $paramListRequest, int $index): ParamList
    {
        $params = [];
        foreach ($paramListRequest->getParamRequests() as $paramRequest) {
            $params[] = $this->generateSingle($paramRequest, $index);
        }
        return ParamList::create($params);
    }

    /** @throws NoParamGeneratorFoundForParamRequest */
    private function generateSingle(ParamRequest $request, int $index): Param
    {
        return $this->paramGeneratorFinder
            ->getConcreteParamGenerator($request)
            ->generate($request, $index);
    }
}