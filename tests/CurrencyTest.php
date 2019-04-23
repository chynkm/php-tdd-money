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
        $moneyFive = Money::dollar(5);
        $this->assertEquals(Money::dollar(10), $moneyFive->times(2));
        $this->assertEquals(Money::dollar(15), $moneyFive->times(3));
    }

    public function testFrancMultiplication()
    {
        $moneyFive = Money::franc(5);
        $this->assertEquals(Money::franc(10), $moneyFive->times(2));
        $this->assertEquals(Money::franc(15), $moneyFive->times(3));
    }

    public function testEquality()
    {
        $this->assertTrue((Money::dollar(5))->equals(Money::dollar(5)));
        $this->assertFalse((Money::dollar(5))->equals(Money::dollar(6)));
        $this->assertTrue((Money::franc(5))->equals(Money::franc(5)));
        $this->assertFalse((Money::franc(5))->equals(Money::franc(6)));
        $this->assertFalse((Money::franc(5))->equals(Money::dollar(5)));
    }
}
