<?php

declare(strict_types=1);

namespace Axtiva\FlexibleGraphql\Federation\Exception;

use Axtiva\FlexibleGraphql\Federation\Representation;
use RuntimeException;

class RepresentationResolverDoesNotFound extends RuntimeException
{
    public function __construct(Representation $representation)
    {
        parent::__construct(sprintf('Representation for %s does not found', $representation->getTypename()));
    }
}