<?php

declare(strict_types=1);

namespace FpDbTest\Exception;

final class NotFoundFormatterException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Нужный форматтер не найден');
    }
}
