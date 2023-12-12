<?php

/*
 * This file is part of the deprecations.io project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DeprecationsIo\Bundle;

use Composer\InstalledVersions;
use DeprecationsIo\Monolog\MonologHandlerClassNameResolver;
use Symfony\Component\HttpKernel\Kernel;

class DeprecationsIoBundleTest extends UnitTest
{
    public function testBootCreatesService()
    {
        $symfonyVersion = explode('.', InstalledVersions::getVersion('symfony/http-kernel'));
        $symfonyVersion = (int) $symfonyVersion[0];

        if ($symfonyVersion <= 5) {
            $kernelClassName = 'Tests\DeprecationsIo\Bundle\Kernel\Symfony2to5Kernel';
        } else {
            $kernelClassName = 'Tests\DeprecationsIo\Bundle\Kernel\Symfony6plusKernel';
        }

        /** @var Kernel $kernel */
        $kernel = new $kernelClassName('test', true);
        $kernel->boot();

        $handler = $kernel->getContainer()->get('deprecationsio.monolog_handler');
        $this->assertInstanceOf(MonologHandlerClassNameResolver::resolveHandlerClassName(), $handler);

        dump($handler);exit;
    }
}
