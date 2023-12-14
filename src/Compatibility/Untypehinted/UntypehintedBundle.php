<?php

/*
 * This file is part of the deprecations.io project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deprecationsio\Bundle\Compatibility\Untypehinted;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Titouan Galopin <titouan@deprecations.io>
 */
class UntypehintedBundle extends Bundle
{
    public function getContainerExtensionClass()
    {
        return 'Deprecationsio\Bundle\Compatibility\Untypehinted\DependencyInjection\UntypehintedExtension';
    }
}
