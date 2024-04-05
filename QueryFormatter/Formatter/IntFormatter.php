<?php

declare(strict_types=1);

namespace FpDbTest\QueryFormatter\Formatter;

use FpDbTest\Exception\BadArgumentException;
use FpDbTest\QueryFormatter\QueryFormatterInterface;

final class IntFormatter implements QueryFormatterInterface
{
    public function format(mixed $arg): mixed
    {
        if (is_array($arg)) {
            throw new BadArgumentException();
        }

        if ($arg === null) {
            return 'NULL';
        }

        return intval($arg);
    }

    public function support(?string $type = null): bool
    {
        return $type === 'd';
    }
}
