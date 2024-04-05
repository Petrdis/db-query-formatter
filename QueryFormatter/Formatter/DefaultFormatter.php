<?php

declare(strict_types=1);

namespace FpDbTest\QueryFormatter\Formatter;

use FpDbTest\Exception\BadArgumentException;
use FpDbTest\QueryFormatter\QueryFormatterInterface;

final readonly class DefaultFormatter implements QueryFormatterInterface
{
    public function __construct(
        private \mysqli $mysqli
    ) {
    }

    public function format(mixed $arg): mixed
    {
        if (!is_string($arg) && !is_int($arg) && !is_bool($arg) && !is_float($arg) && !is_null($arg)) {
            throw new BadArgumentException();
        }

        if ($arg === '') {
            throw new BadArgumentException();
        }

        if (is_string($arg)) {
            return sprintf("'%s'", $this->mysqli->real_escape_string($arg));
        }

        if (is_bool($arg)) {
            return (int) $arg;
        }

        if ($arg === null) {
            return 'NULL';
        }

        return $arg;
    }

    public function support(?string $type = null): bool
    {
        return $type === null;
    }
}
