<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Classes\Dollar;
use App\Classes\Franc;
use App\Classes\Money;

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

    public function testEquality()
    {
        $this->assertTrue((new Dollar(5))->equals(new Dollar(5)));
        $this->assertFalse((new Dollar(5))->equals(new Dollar(6)));
        $this->assertTrue((new Franc(5))->equals(new Franc(5)));
        $this->assertFalse((new Franc(5))->equals(new Franc(6)));
        $this->assertFalse((new Franc(5))->equals(new Dollar(5)));
    }
}
