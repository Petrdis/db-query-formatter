<?php

declare(strict_types=1);

namespace FpDbTest\Enum;

enum SpecialBlockEnum: string
{
    /** Можно пометить блок для пропуска */
    case Skip = '__SKIP__';
}
