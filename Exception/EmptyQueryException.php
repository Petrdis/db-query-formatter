<?php

declare(strict_types=1);

namespace FpDbTest\Exception;

final class EmptyQueryException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Передана пустая строка');
    }
}
