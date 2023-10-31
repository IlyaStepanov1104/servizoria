<?php

require './vendor/autoload.php';
require 'TextCallStatistic.php';

use PHPUnit\Framework\TestCase;

class TextCallStatisticTest extends TestCase
{

    public function testAnalyseFileNotFoundException()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('File not found!');

        new TextCallStatistic("test.txt");
    }

    public function testAnalyse_1()
    {
        $statistic = new TextCallStatistic('text/test_1.txt');
        $this->assertTrue($statistic->isHello());
        $this->assertTrue($statistic->isIntroduced());
        $this->assertEquals(1, $statistic->getCalled());
    }

    public function testAnalyse_2()
    {
        $statistic = new TextCallStatistic('text/test_2.txt');
        $this->assertTrue($statistic->isHello());
        $this->assertTrue($statistic->isIntroduced());
        $this->assertEquals(1, $statistic->getCalled());
    }

    public function testAnalyse_3_EmptyText()
    {
        $statistic = new TextCallStatistic('text/test_3.txt');
        $this->assertFalse($statistic->isHello());
        $this->assertFalse($statistic->isIntroduced());
        $this->assertEquals(0, $statistic->getCalled());
    }
}
