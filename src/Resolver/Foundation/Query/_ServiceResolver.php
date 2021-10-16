<?php

declare(strict_types=1);

namespace Axtiva\FlexibleGraphql\Federation\Resolver\Foundation\Query;

use Axtiva\FlexibleGraphql\Federation\Resolver\_ServiceResolverInterface;
use GraphQL\Type\Definition\ResolveInfo;

class _ServiceResolver implements _ServiceResolverInterface
{
    private string $schema;

    public function __construct(string $graphqlSchemaSDL)
    {
        $this->schema = $graphqlSchemaSDL;
    }

    public function __invoke($rootValue, $args, $context, ResolveInfo $info)
    {
        return [
            'sdl' => $this->schema,
        ];
    }
}