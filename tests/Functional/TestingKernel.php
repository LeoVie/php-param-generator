<?php

declare(strict_types=1);

namespace LeoVie\PhpParamGenerator\Tests\Functional;

use LeoVie\PhpParamGenerator\PhpParamGeneratorBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class TestingKernel extends Kernel
{
    public function registerBundles(): array
    {
        return [
            new PhpParamGeneratorBundle()
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    }
}