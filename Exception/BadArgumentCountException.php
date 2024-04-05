<?php

declare(strict_types=1);

namespace FpDbTest\Exception;

final class BadArgumentCountException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Передано неверное количество аргументов');
    }
}
