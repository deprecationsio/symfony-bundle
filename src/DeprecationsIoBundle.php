<?php

/*
 * This file is part of the deprecations.io project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DeprecationsIo\Bundle;

use Symfony\Component\HttpKernel\Kernel;

// Dynamic definition based on Symfony version
if (Kernel::MAJOR_VERSION >= 6) {
    class_alias('DeprecationsIo\Bundle\Symfony6plus\DeprecationsIoBundle', 'DeprecationsIo\Bundle\DeprecationsIoBundle');
} else {
    class_alias('DeprecationsIo\Bundle\Symfony2to5\DeprecationsIoBundle', 'DeprecationsIo\Bundle\DeprecationsIoBundle');
}
