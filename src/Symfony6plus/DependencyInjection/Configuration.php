<?php

/*
 * This file is part of the deprecations.io project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DeprecationsIo\Bundle\Symfony6plus\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Titouan Galopin <titouan@deprecations.io>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('deprecations_io');

        $rootNode = $treeBuilder->getRootNode();
        $rootNode->children()->scalarNode('dsn')->isRequired()->end()->end();

        return $treeBuilder;
    }
}
