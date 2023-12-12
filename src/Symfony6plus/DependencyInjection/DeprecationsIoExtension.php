<?php

/*
 * This file is part of the flysystem-bundle project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DeprecationsIo\Bundle\Symfony6plus\DependencyInjection;

use DeprecationsIo\Monolog\MonologHandlerClassNameResolver;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Titouan Galopin <titouan@deprecations.io>
 */
class DeprecationsIoExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $handlerClassName = MonologHandlerClassNameResolver::resolveHandlerClassName();

        $container
            ->setDefinition('deprecationsio.monolog_handler', new Definition($handlerClassName))
            ->addArgument($config['dsn'])
            ->setPublic(true)
        ;
    }
}
