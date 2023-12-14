<?php

/*
 * This file is part of the deprecations.io project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deprecationsio\Bundle;

use Symfony\Component\HttpKernel\Kernel;

// Dynamic definition based on Symfony version
if (Kernel::MAJOR_VERSION >= 6) {
    class DeprecationsioBundle extends \Deprecationsio\Bundle\Compatibility\Typehinted\TypehintedBundle
    {
    }
} else {
    class DeprecationsioBundle extends \Deprecationsio\Bundle\Compatibility\Untypehinted\UntypehintedBundle
    {
    }
}
