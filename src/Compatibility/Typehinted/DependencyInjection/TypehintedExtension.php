<?php

/*
 * This file is part of the flysystem-bundle project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deprecationsio\Bundle\Compatibility\Typehinted\DependencyInjection;

use Deprecationsio\Bundle\Common\DependencyInjectionExtension as CommonExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Titouan Galopin <titouan@deprecations.io>
 */
class TypehintedExtension extends Extension
{
    public function getAlias(): string
    {
        return 'deprecationsio';
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        CommonExtension::loadContainer(
            $config,
            $container,
            'Deprecationsio\Bundle\Compatibility\Typehinted\CacheWarmer\ContainerDeprecationsCacheWarmer'
        );
    }
}
