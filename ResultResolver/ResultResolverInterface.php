<?php

declare(strict_types=1);

namespace FpDbTest\ResultResolver;

interface ResultResolverInterface
{
    public function resolve(string $query): string;
}
