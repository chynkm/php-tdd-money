<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Classes\Dollar;
use App\Classes\Franc;

class CurrencyTest extends TestCase
{
    public function testMultiplication()
    {
        $dollarFive = new Dollar(5);
        $this->assertEquals(new Dollar(10), $dollarFive->times(2));
        $this->assertEquals(new Dollar(15), $dollarFive->times(3));
    }

    public function testFrancMultiplication()
    {
        $francFive = new Franc(5);
        $this->assertEquals(new Franc(10), $francFive->times(2));
        $this->assertEquals(new Franc(15), $francFive->times(3));
    }
}
