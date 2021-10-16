<?php

declare(strict_types=1);

namespace Axtiva\FlexibleGraphql\Federation\Resolver\Foundation\Query;

use Axtiva\FlexibleGraphql\Federation\Exception\RepresentationResolverDoesNotFound;
use Axtiva\FlexibleGraphql\Federation\Representation;
use Axtiva\FlexibleGraphql\Federation\Resolver\_EntitiesResolverInterface;
use Axtiva\FlexibleGraphql\Federation\Resolver\FederationRepresentationResolverInterface;
use GraphQL\Type\Definition\ResolveInfo;

class _EntitiesResolver implements _EntitiesResolverInterface
{
    /**
     * @var FederationRepresentationResolverInterface[]
     */
    private array $resolvers;

    public function __construct(FederationRepresentationResolverInterface ...$resolvers)
    {
        foreach ($resolvers as $resolver) {
            $this->resolvers[$resolver->getTypeName()] = $resolver;
        }
    }

    public function __invoke($rootValue, $args, $context, ResolveInfo $info)
    {
        $result = [];
        foreach ($args['representations'] ?? [] as $representation) {
            $representation = new Representation($representation);
            if (empty($this->resolvers[$representation->getTypename()])) {
                throw new RepresentationResolverDoesNotFound($representation);
            }

            $result[] = $this->resolvers[$representation->getTypename()]->__invoke($representation, $context, $info);
        }

        return $result;
    }
}