<?php

namespace FpDbTest\QueryFormatter;

use FpDbTest\Exception\BadArgumentException;

interface QueryFormatterInterface
{
    /**
     * @throws BadArgumentException
     */
    public function format(mixed $arg): mixed;

    public function support(?string $type = null): bool;
}