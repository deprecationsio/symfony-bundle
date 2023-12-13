### Setup for Symfony 5.x

1. Install the bundle using Composer:

```
composer require deprecations-io/symfony-bundle
```

2. Enable the bundle in your `config/bundles.php` file:

```php
// config/bundles.php
return [
    // ...
    DeprecationsIo\Bundle\DeprecationsIoBundle::class => ['all' => true],
];

```

3. Create a new `config/packages/deprecationsio.yml` configuration file:

```yaml
deprecations_io:
    dsn: 'https://ingest.deprecations.io/?apikey=<your-api-key>'
```

4. Use the Monolog handler defined by the bundle in your configuration:

> *Tip*: you should configure the deprecationsio handler in all Symfony environments (all 
> when@dev, when@prod, when@test, ... sections) to ensure you will catch as many deprecations 
> as possible!

```yaml
# config/packages/monolog.yaml
when@dev:
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
            # main:
            # ...

when@test:
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
            # main:
            # ...

when@prod:
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
            # main:
            # ...
```
