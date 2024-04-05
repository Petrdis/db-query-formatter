<?php

declare(strict_types=1);

namespace FpDbTest\ResultResolver\Resolver;

use FpDbTest\ResultResolver\ResultResolverInterface;

final class RemoveSpecialBlockCharsResultResolver implements ResultResolverInterface
{
    public function __construct(
      private ResultResolverInterface $resolver
    ) {
    }

    public function resolve(string $query): string
    {
        $query = $this->resolver->resolve($query);

        return preg_replace('/\{(.*)\}/', '$1', $query);
    }
}
