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

use DeprecationsIo\Bundle\DeprecationsIoBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class Symfony6plusKernel extends Kernel
{
    public function getCacheDir(): string
    {
        return $this->createTmpDir('cache');
    }

    public function getLogDir(): string
    {
        return $this->createTmpDir('logs');
    }

    public function registerBundles(): iterable
    {
        return array(
            new DeprecationsIoBundle(),
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->loadFromExtension('deprecations_io', array(
                'dsn' => 'https://ingest.deprecations.io/example?apikey=test',
            ));
        });
    }

    private function createTmpDir($type)
    {
        $dir = sys_get_temp_dir().'/deprecationsio_bundle/'.uniqid($type.'_', true);

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        return $dir;
    }
}
