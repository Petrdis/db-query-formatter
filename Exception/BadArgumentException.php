<?php

declare(strict_types=1);

namespace FpDbTest\Exception;

final class BadArgumentException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Неверный тип аргумента');
    }
}
