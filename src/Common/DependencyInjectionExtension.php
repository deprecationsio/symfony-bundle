<?php

/*
 * This file is part of the flysystem-bundle project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deprecationsio\Bundle\Common;

use Deprecationsio\Monolog\MonologHandlerClassNameResolver;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Titouan Galopin <titouan@deprecations.io>
 */
class DependencyInjectionExtension
{
    public static function createTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('deprecationsio');

        $rootNode = method_exists($treeBuilder, 'getRootNode') ? $treeBuilder->getRootNode() : $treeBuilder->root('deprecationsio');
        $rootNode->children()->scalarNode('dsn')->isRequired()->end()->end();

        return $treeBuilder;
    }

    public static function loadContainer(array $config, ContainerBuilder $container, $containerCollectorClassName)
    {
        // Client
        $container
            ->setDefinition('deprecationsio.client', new Definition('Deprecationsio\Monolog\Client\CurlDeprecationsioClient'))
            ->setPublic(false);

        // Monolog handler
        $handlerClassName = MonologHandlerClassNameResolver::resolveHandlerClassName();
        $container
            ->setDefinition('deprecationsio.monolog_handler', new Definition($handlerClassName))
            ->addArgument($config['dsn'])
            ->addArgument(new Reference('deprecationsio.client'))
            ->setPublic(false);

        // Container build deprecations collector
        $container
            ->setDefinition('deprecationsio.container_collector_cache_warmer', new Definition($containerCollectorClassName))
            ->addArgument(new Reference('deprecationsio.client'))
            ->addArgument($config['dsn'])
            ->addArgument('%kernel.cache_dir%/%kernel.container_class%')
            ->addTag('kernel.cache_warmer')
            ->setPublic(false);
    }
}
