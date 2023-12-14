<?php

/*
 * This file is part of the deprecations.io project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deprecationsio\Bundle\Compatibility\Typehinted;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Titouan Galopin <titouan@deprecations.io>
 */
class TypehintedBundle extends Bundle
{
    public function getContainerExtensionClass(): string
    {
        return 'Deprecationsio\Bundle\Compatibility\Typehinted\DependencyInjection\TypehintedExtension';
    }
}
