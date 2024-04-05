<?php

declare(strict_types=1);

namespace FpDbTest\ResultResolver\Resolver;
use FpDbTest\ResultResolver\ResultResolverInterface;

final class RemoveSkipBlockResultResolver implements ResultResolverInterface
{
    public function resolve(string $query): string
    {
        return preg_replace('/\{[^{}]*__SKIP__[^{}]*\}/', '', $query);
    }
}