<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Receipt;

class ReceiptTest extends TestCase
{
    protected $receipt;

    public function setUp(): void
    {
        $this->receipt = new Receipt;
    }

    public function tearDown(): void
    {
        unset($this->receipt);
    }

    /**
     * @dataProvider provideTotal
     */
    public function testTotal($items, $expected)
    {
        $coupon = null;
        $output = $this->receipt->total($items, $coupon);
        $this->assertEquals(
            $expected,
            $output,
            "Total sum should be {$expected}"
        );
    }

    public function provideTotal()
    {
        return [
            [[1, 2, 5, 8], 16],
            [[-1, 2, 5, 8], 14],
            [[1, 2, 8], 11],
        ];
    }

    public function testTotalAndCoupon()
    {
        $input = [0, 2, 5, 8];
        $coupon = 0.20;
        $output = $this->receipt->total($input, $coupon);
        $this->assertEquals(
            12,
            $output,
            'Total sum should be 15'
        );
    }

    public function testTotalException()
    {
        $input = [0, 2, 5, 8];
        $coupon = 1.20;
        $this->expectException('BadMethodCallException');
        $this->receipt->total($input, $coupon);
    }

    public function testPostTaxTotal()
    {
        $items = [1, 2, 5, 8];
        $tax = 0.20;
        $coupon = null;
        $receipt = $this->getMockBuilder('App\Receipt')
            ->setMethods(['tax', 'total'])
            ->getMock();

        $receipt->expects($this->once()) // expects to call the total() methods once
            ->method('total')
            ->with($items, $coupon)
            ->will($this->returnValue(10.00));

        $receipt->expects($this->once())
            ->method('tax')
            ->with(10.00, $tax)
            ->will($this->returnValue(1.00));

        $result = $receipt->postTaxTotal([1, 2, 5, 8], 0.20, null);
        $this->assertEquals(11.00, $result);
    }

    public function testTax()
    {
        $inputAmount = 10.00;
        $taxInput = 0.10;

        $output = $this->receipt->tax($inputAmount, $taxInput);
        $this->assertEquals(
            1.00,
            $output,
            'tax calculate = 1.00'
        );
    }

    /**
     * @dataProvider provideCurrencyAmt
     */
    public function testCurrencyAmount($input, $expected, $msg)
    {
        $this->assertSame(
            $expected,
            $this->receipt->currencyAmt($input),
            $msg
        );
    }

    public function provideCurrencyAmt()
    {
        return [
            [1, 1.00, '1 should be 1.00'],
            [1.1, 1.10, '1.1 should be 1.10'],
            [1.11, 1.11, '1.11 should be 1.11'],
            [1.111, 1.11, '1.111 should be 1.11'],
        ];
    }
}
