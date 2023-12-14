<?php

/*
 * This file is part of the flysystem-bundle project.
 *
 * (c) Titouan Galopin <galopintitouan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\DeprecationsIo\Bundle\Kernel;

use DeprecationsIo\Bundle\DeprecationsioBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class Symfony2to5Kernel extends Kernel
{
    public function getCacheDir()
    {
        return $this->createTmpDir('cache');
    }

    private function createTmpDir($type)
    {
        $dir = sys_get_temp_dir() . '/deprecationsio_bundle/' . uniqid($type . '_', true);

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        return $dir;
    }

    public function getLogDir()
    {
        return $this->createTmpDir('logs');
    }

    public function registerBundles()
    {
        return array(
            new DeprecationsioBundle(),
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->loadFromExtension('deprecationsio', array(
                'dsn' => 'https://ingest.deprecations.io/example?apikey=test',
            ));

            foreach (array('monolog_handler', 'container_collector_cache_warmer') as $serviceName) {
                if ($alias = $container->setAlias('test.deprecationsio.'.$serviceName, 'deprecationsio.'.$serviceName)) {
                    $alias->setPublic(true);
                }
            }
        });
    }
}
