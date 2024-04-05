<?php

declare(strict_types=1);

namespace FpDbTest;

use FpDbTest\Enum\SpecialBlockEnum;
use FpDbTest\Exception\BadArgumentCountException;
use FpDbTest\Exception\BadArgumentException;
use FpDbTest\Exception\EmptyQueryException;
use FpDbTest\Exception\NotFoundFormatterException;
use FpDbTest\QueryFormatter\QueryFormatterFactory;
use FpDbTest\ResultResolver\ResultResolverInterface;

final readonly class Database implements DatabaseInterface
{
    public function __construct(
        private QueryFormatterFactory $formatterFactory,
        private ResultResolverInterface $resultResolver
    ) {
    }

    /**
     * @throws NotFoundFormatterException
     * @throws EmptyQueryException
     * @throws BadArgumentCountException
     * @throws BadArgumentException
     */
    public function buildQuery(string $query, array $args = []): string
    {
        if ($query === '') {
            throw new EmptyQueryException();
        }

        $formattedQuery = preg_replace_callback(
            '/\?([#daf]|\?#)?/',
            function ($matches) use (&$args) {
                if ($args == []) {
                    throw new BadArgumentCountException();
                }

                $type = $matches[1] ?? null;
                $arg = array_shift($args);

                $formatter = $this->formatterFactory->get($arg, $type);

                return $formatter->format($arg);
            },
            $query
        );

        if ($args !== []) {
            throw new BadArgumentCountException();
        }

        return $this->resultResolver->resolve($formattedQuery);
    }

    public function skip(): string
    {
        return SpecialBlockEnum::Skip->value;
    }
}
