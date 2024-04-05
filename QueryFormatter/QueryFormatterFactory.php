<?php

declare(strict_types=1);

namespace FpDbTest\QueryFormatter;

use FpDbTest\Enum\SpecialBlockEnum;
use FpDbTest\Exception\NotFoundFormatterException;

final readonly class QueryFormatterFactory
{
    /**
     * @param iterable<QueryFormatterInterface> $formatters
     */
    public function __construct(
        private iterable $formatters
    ) {
    }

    /**
     * @throws NotFoundFormatterException
     */
    public function get(mixed $arg, ?string $type = null): QueryFormatterInterface
    {
        if ($arg === SpecialBlockEnum::Skip->value) {
            $type = $arg;
        }

        foreach ($this->formatters as $formatter) {
            if ($formatter->support($type)) {
                return $formatter;
            }
        }

        throw new NotFoundFormatterException();
    }
}
