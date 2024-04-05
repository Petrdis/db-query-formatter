<?php

use FpDbTest\Database;
use FpDbTest\DatabaseTest;

spl_autoload_register(function ($class) {
    $a = array_slice(explode('\\', $class), 1);
    if (!$a) {
        throw new Exception();
    }
    $filename = implode('/', [__DIR__, ...$a]) . '.php';
    require_once $filename;
});


$mysqli = @new mysqli($_ENV['MYSQL_HOST'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE'], $_ENV['MYSQL_PORT']);
if ($mysqli->connect_errno) {
    throw new Exception($mysqli->connect_error);
}

$defaultFormatter = new \FpDbTest\QueryFormatter\Formatter\DefaultFormatter($mysqli);
$formatterFactory = new \FpDbTest\QueryFormatter\QueryFormatterFactory([
    $defaultFormatter,
    new \FpDbTest\QueryFormatter\Formatter\ArrayFormatter($defaultFormatter),
    new \FpDbTest\QueryFormatter\Formatter\FloatFormatter(),
    new \FpDbTest\QueryFormatter\Formatter\IdentifierFormatter($mysqli),
    new \FpDbTest\QueryFormatter\Formatter\IntFormatter(),
    new \FpDbTest\QueryFormatter\Formatter\SkipFormatter(),
]);

$resultResolver = new \FpDbTest\ResultResolver\Resolver\RemoveSpecialBlockCharsResultResolver(
  new \FpDbTest\ResultResolver\Resolver\RemoveSkipBlockResultResolver()
);

$db = new Database($formatterFactory, $resultResolver);
$test = new DatabaseTest($db);
$test->testBuildQuery();

exit('OK');
