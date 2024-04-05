<?php

namespace FpDbTest\QueryFormatter\Formatter;

use FpDbTest\QueryFormatter\QueryFormatterInterface;

final readonly class IdentifierFormatter implements QueryFormatterInterface
{
    public function __construct(
        private \mysqli $mysqli
    ) {
    }

    public function format(mixed $arg): string
    {
        if (is_array($arg)) {
            return sprintf('`%s`', $this->mysqli->real_escape_string(implode('`, `', $arg)));
        }

        return "`" . $this->mysqli->real_escape_string($arg) . "`";
    }

    public function support(?string $type = null): bool
    {
        return $type === '#';
    }
}
