<?php

declare(strict_types=1);

namespace FpDbTest\QueryFormatter\Formatter;

use FpDbTest\Enum\SpecialBlockEnum;
use FpDbTest\QueryFormatter\QueryFormatterInterface;

final class SkipFormatter implements QueryFormatterInterface
{
    public function format(mixed $arg): string
    {
        return SpecialBlockEnum::Skip->value;
    }

    public function support(?string $type = null): bool
    {
        return $type === SpecialBlockEnum::Skip->value;
    }
}
