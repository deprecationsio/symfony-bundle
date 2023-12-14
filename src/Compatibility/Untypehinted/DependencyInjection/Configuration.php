<?php

/*
 * This file is part of the deprecations.io project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deprecationsio\Bundle\Compatibility\Untypehinted\DependencyInjection;

use Deprecationsio\Bundle\Common\DependencyInjectionExtension;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Titouan Galopin <titouan@deprecations.io>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        return DependencyInjectionExtension::createTreeBuilder();
    }
}
