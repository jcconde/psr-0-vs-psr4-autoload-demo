<?php

require __DIR__ . '/vendor/autoload.php';

use PSR0\Demo\HelloWorld as HelloWorld0;
use PSR4\Demo\HelloWorld as HelloWorld4;

$psr0 = new HelloWorld0();
$psr4 = new HelloWorld4();

echo $psr0->greet() . PHP_EOL;
echo $psr4->greet() . PHP_EOL;
