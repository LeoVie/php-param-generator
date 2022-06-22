<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Unit\Model\ParamRequest;

use LeoVie\PhpParamGenerator\Model\ParamRequest\IntRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\ObjectRequest;
use LeoVie\PhpParamGenerator\Model\ParamRequest\StringRequest;
use PHPUnit\Framework\TestCase;

class ObjectRequestTest extends TestCase
{
    public function testCreate(): void
    {
        $bootstrapScriptPath = '/var/www/vendor/autoload.php';
        /** @var class-string $classFQN */
        $classFQN = '\\LeoVie\\Example\\FooClass';
        $constructorTypes = [
            new StringRequest(),
            new IntRequest()
        ];
        $objectRequest = ObjectRequest::create($bootstrapScriptPath, $classFQN, $constructorTypes);

        self::assertInstanceOf(ObjectRequest::class, $objectRequest);
        self::assertSame($bootstrapScriptPath, $objectRequest->getBootstrapScriptPath());
        self::assertSame($classFQN, $objectRequest->getClassFQN());
        self::assertSame($constructorTypes, $objectRequest->getConstructorTypes());
    }
}