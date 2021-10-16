<?php

namespace Axtiva\FlexibleGraphql\Federation\Resolver;

use Axtiva\FlexibleGraphql\Federation\Representation;
use GraphQL\Type\Definition\ResolveInfo;

interface FederationRepresentationResolverInterface
{
    public function getTypeName(): string;
    public function __invoke(Representation $representation, $context, ResolveInfo $info);
}