### Setup for Symfony 4.x

> If you didn't upgrade the directory structure of your Symfony application to the 
> [Symfony 4 structure](http://fabien.potencier.org/symfony4-directory-structure.html),
> please follow the [Symfony 3.x setup instructions](setup-3.md).

1. Install the bundle using Composer:

```
composer require deprecations-io/symfony-bundle
```

2. Enable the bundle in your `config/bundles.php` file:

```php
// config/bundles.php
return [
    // ...
    Deprecationsio\Bundle\DeprecationsioBundle::class => ['all' => true],
];

```

3. Create a new `config/packages/deprecationsio.yml` configuration file:

```yaml
deprecationsio:
    dsn: 'https://ingest.deprecations.io/?apikey=<your-api-key>'
```

4. Use the Monolog handler defined by the bundle in your configuration:

> *Tip*: you should configure the deprecationsio handler in all Symfony environments
> (config/packages/dev/monolog.yaml, config/packages/test/monolog.yaml and config/packages/prod/monolog.yaml) 
> to ensure you will catch as many deprecations as possible!

> *Careful*: if you have defined the `framework.php_errors` configuration option
> ([see documentation](https://symfony.com/doc/3.4/reference/configuration/framework.html#php-errors)),
> be sure that it does not exclude deprecations, otherwise you will not receive deprecations
> in your Monolog handlers.

```yaml
# config/packages/[dev|test|prod]/monolog.yaml
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
            path: "%kernel.logs_dir%/%kernel.environment%.log"
            level: debug
            channels: ["!event"]
        console:
            type: console
            process_psr_3_messages: false
            channels: ["!event", "!doctrine", "!console"]

        # ...
```
