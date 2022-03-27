# flexible-graphql-federation

Extension for [axtiva/flexible-graphql-php](https://github.com/axtiva/flexible-graphql-php) for support [Apollo Federation](https://www.apollographql.com/docs/federation/) 
in php implementation as SDL first code generation.

# Install

```
composer require axtiva/flexible-graphql-federation
```

## Integration into [axtiva/flexible-graphql-php](https://github.com/axtiva/flexible-graphql-php)

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Axtiva\FlexibleGraphql\Builder\Foundation\CodeGeneratorBuilder;
use Axtiva\FlexibleGraphql\Utils\SchemaBuilder;
use Axtiva\FlexibleGraphql\Generator\Config\Foundation\Psr4\CodeGeneratorConfig;
use Axtiva\FlexibleGraphql\Generator\Config\Foundation\Psr4\FieldResolverGeneratorConfig;
use Axtiva\FlexibleGraphql\Federation\Generator\Model\Foundation\Psr4\_EntitiesResolverGenerator;
use Axtiva\FlexibleGraphql\Federation\Generator\Model\Foundation\Psr4\_ServiceResolverGenerator;
use Axtiva\FlexibleGraphql\Federation\Generator\Config\Foundation\Psr4\FederationRepresentationResolverGeneratorConfig;
use Axtiva\FlexibleGraphql\Federation\Generator\model\Foundation\Psr4\FederationRepresentationResolverGenerator;
use Axtiva\FlexibleGraphql\FederationExtension\FederationSchemaExtender;

$namespace = 'Axtiva\FlexibleGraphql\Example\GraphQL';
$dir = __DIR__ . '/GraphQL';
$mainConfig = new CodeGeneratorConfig($dir, CodeGeneratorConfig::V7_4, $namespace);
$builder = new CodeGeneratorBuilder($mainConfig);
$fieldResolverConfig = new FieldResolverGeneratorConfig($mainConfig);
$representationConfig = new FederationRepresentationResolverGeneratorConfig($mainConfig);

$builder->addFieldResolverGenerator(new _EntitiesResolverGenerator($fieldResolverConfig));
$builder->addFieldResolverGenerator(new _ServiceResolverGenerator($fieldResolverConfig));
$builder->addModelGenerator(new FederationRepresentationResolverGenerator($representationConfig));

$generator = $builder->build();

$schema = FederationSchemaExtender::build(SchemaBuilder::build('/path/to/schema.graphql'));

foreach ($generator->generateAllTypes($schema) as $filename);
```