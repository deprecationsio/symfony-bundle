<?php

/*
 * This file is part of the deprecations.io project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DeprecationsIo\Bundle;

if (!class_exists('PHPUnit\Framework\TestCase')) {
    class_alias('PHPUnit_Framework_TestCase', 'PHPUnit\Framework\TestCase');
}

use PHPUnit\Framework\TestCase;

abstract class UnitTest extends TestCase
{
}
