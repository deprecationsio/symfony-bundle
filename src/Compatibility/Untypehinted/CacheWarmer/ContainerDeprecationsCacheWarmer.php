<?php

/*
 * This file is part of the deprecations.io project.
 *
 * (c) Titouan Galopin <titouan@deprecations.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DeprecationsIo\Bundle\Compatibility\Untypehinted\CacheWarmer;

use DeprecationsIo\Bundle\Common\ContainerDeprecationsCollector;
use DeprecationsIo\Monolog\Client\DeprecationsIoClientInterface;
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;

/**
 * @author Titouan Galopin <titouan@deprecations.io>
 */
class ContainerDeprecationsCacheWarmer implements CacheWarmerInterface
{
    private $client;
    private $dsn;
    private $containerPathPrefix;

    /**
     * @param DeprecationsIoClientInterface $client
     * @param string $dsn
     * @param string $containerPathPrefix
     */
    public function __construct($client, $dsn, $containerPathPrefix)
    {
        $this->client = $client;
        $this->dsn = $dsn;
        $this->containerPathPrefix = $containerPathPrefix;
    }

    public function isOptional()
    {
        return false;
    }

    public function warmUp($cacheDir)
    {
        ContainerDeprecationsCollector::collectLogs($this->client, $this->dsn, $this->containerPathPrefix);
    }
}
