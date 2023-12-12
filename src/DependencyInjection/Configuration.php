<?php

/*
 * This file is part of the deprecations.io project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DeprecationsIo\Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Titouan Galopin <titouan@deprecations.io>
 *
 * @internal
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('deprecations_io');

        $rootNode = method_exists($treeBuilder, 'getRootNode') ? $treeBuilder->getRootNode() : $treeBuilder->root('deprecations_io');
        $rootNode->children()->scalarNode('dsn')->isRequired()->end()->end();

        return $treeBuilder;
    }
}
