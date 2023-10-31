<?php
include 'TextCallStatistic.php';

$statistic = new TextCallStatistic('text/test_3.txt');
echo "\tПоздаровался - {$statistic->isHello()}\n";
echo "\tПредставился - {$statistic->isIntroduced()}\n";
echo "\tОбратился по имени - {$statistic->getCalled()} раз\n";
