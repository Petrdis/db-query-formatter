<?php

declare(strict_types=1);

namespace FpDbTest\QueryFormatter\Formatter;

use FpDbTest\Exception\BadArgumentException;
use FpDbTest\QueryFormatter\QueryFormatterInterface;

final readonly class ArrayFormatter implements QueryFormatterInterface
{
    public function __construct(
        private QueryFormatterInterface $defaultFormatter
    ) {
    }

    /**
     * @throws BadArgumentException
     */
    public function format(mixed $arg): string
    {
        if (!is_array($arg)) {
            throw new BadArgumentException();
        }

        $str = '';
        $countArgs = count($arg);
        $i = 0;
        foreach ($arg as $key => $item) {
            $i++;
            if (array_is_list($arg)) {
                $str .= $this->defaultFormatter->format($item);
            } else {
                $str .= sprintf('`%s` = %s', $key, $this->defaultFormatter->format($item));
            }

            if ($i < $countArgs) {
                $str .= ', ';
            }
        }

        return $str;
    }

    public function support(?string $type = null): bool
    {
        return $type === 'a';
    }
}
