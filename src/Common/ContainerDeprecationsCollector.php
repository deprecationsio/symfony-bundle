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

use Deprecationsio\Monolog\Client\DeprecationsioClientInterface;
use Deprecationsio\Monolog\Context\EventFactory;

/**
 * @author Titouan Galopin <titouan@deprecations.io>
 */
class ContainerDeprecationsCollector
{
    public static function collectLogs(DeprecationsioClientInterface $client, $dsn, $containerPathPrefix)
    {
        if (null === $containerPathPrefix || !file_exists($file = $containerPathPrefix . 'Deprecations.log')) {
            return;
        }

        if ('' === $logContent = trim(file_get_contents($file))) {
            return;
        }

        $eventFactory = new EventFactory();
        $event = $eventFactory->createEvent(PHP_SAPI);

        foreach (unserialize($logContent) as $log) {
            $event->addDeprecation(
                !empty($log['message']) ? $log['message'] : '',
                $log['file'],
                $log['line'],
                $log['trace']
            );
        }

        if ($event->hasDeprecations()) {
            $client->sendEvent($dsn, $event);
        }
    }
}
