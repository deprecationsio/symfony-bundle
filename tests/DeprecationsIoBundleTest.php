<?php

/*
 * This file is part of the deprecations.io project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Deprecationsio\Bundle;

use Composer\InstalledVersions;
use Deprecationsio\Monolog\MonologHandlerClassNameResolver;
use Symfony\Component\HttpKernel\Kernel;

class DeprecationsioBundleTest extends UnitTest
{
    public function testBootCreatesService()
    {
        $symfonyVersion = explode('.', InstalledVersions::getVersion('symfony/http-kernel'));
        $symfonyVersion = (int)$symfonyVersion[0];

        if ($symfonyVersion <= 5) {
            $kernelClassName = 'Tests\Deprecationsio\Bundle\Kernel\Symfony2to5Kernel';
        } else {
            $kernelClassName = 'Tests\Deprecationsio\Bundle\Kernel\Symfony6plusKernel';
        }

        /** @var Kernel $kernel */
        $kernel = new $kernelClassName('test', true);
        $kernel->boot();

        $handler = $kernel->getContainer()->get('test.deprecationsio.monolog_handler');
        $this->assertInstanceOf(MonologHandlerClassNameResolver::resolveHandlerClassName(), $handler);

        $containerCollector = $kernel->getContainer()->get('test.deprecationsio.container_collector_cache_warmer');
        $this->assertInstanceOf('Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface', $containerCollector);
    }
}
