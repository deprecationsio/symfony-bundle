### Setup for Symfony 2.8

1. Install the bundle using Composer:

```
composer require deprecations-io/symfony-bundle
```

2. Enable the bundle in your `AppKernel.php` file:

```php
// app/AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new DeprecationsIo\Bundle\DeprecationsIoBundle(),
        );
        
        // ...
    }
    
    // ...
}
```

3. Configure the bundle in your `config.yml` file:

```yaml
deprecationsio:
    dsn: 'https://ingest.deprecations.io/?apikey=<your-api-key>'
```

4. Use the Monolog handler defined by the bundle in your configuration:

> *Tip*: you should configure the deprecationsio handler in all Symfony environments
> (config_dev.yaml, config_test.yaml and config_prod.yaml) to ensure you will catch 
> as many deprecations as possible!

```yaml
# config_dev.yaml, config_test.yaml, config_prod.yaml
monolog:
    handlers:
        # Make sure to put your deprecations.io handler before all other handlers to be certain 
        # it will be called for all deprecations.
        deprecationsio_buffer:
            type: buffer
            buffer_size: 100
            handler: deprecationsio
        deprecationsio:
            type: service
            id: 'deprecationsio.monolog_handler'

        # Your other usual handlers ...
        main:
            type: stream
            path: '%kernel.logs_dir%/%kernel.environment%.log'
            level: debug
            channels: ['!event']
        console:
            type: console
            channels: ['!event', '!doctrine']
        # ...
```
