<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\ParamRequest;

use LeoVie\PhpParamGenerator\Model\ParamRequest\NullRequest;
use PHPUnit\Framework\TestCase;

class NullRequestTest extends TestCase
{
    public function testCreate(): void
    {
        self::assertInstanceOf(NullRequest::class, NullRequest::create());
    }
}