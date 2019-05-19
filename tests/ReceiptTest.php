<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Receipt;

class ReceiptTest extends TestCase
{
    protected $receipt;

    public function setUp(): void
    {
        $this->formatter = $this->getMockBuilder('App\Formatter')
            ->setMethods(['currencyAmt'])
            ->getMock();
        $this->formatter->expects($this->any())
            ->method('currencyAmt')
            ->with($this->anything())
            ->will($this->returnArgument(0));

        $this->receipt = new Receipt($this->formatter);
    }

    public function tearDown(): void
    {
        unset($this->receipt);
    }

    /**
     * @dataProvider provideSubTotal
     */
    public function testSubTotal($items, $expected)
    {
        $coupon = null;
        $output = $this->receipt->subTotal($items, $coupon);
        $this->assertEquals(
            $expected,
            $output,
            "Total sum should be {$expected}"
        );
    }

    public function provideSubTotal()
    {
        return [
            [[1, 2, 5, 8], 16],
            [[-1, 2, 5, 8], 14],
            [[1, 2, 8], 11],
        ];
    }

    public function testSubTotalAndCoupon()
    {
        $input = [0, 2, 5, 8];
        $coupon = 0.20;
        $output = $this->receipt->subTotal($input, $coupon);
        $this->assertEquals(
            12,
            $output,
            'Total sum should be 15'
        );
    }

    public function testSubTotalException()
    {
        $input = [0, 2, 5, 8];
        $coupon = 1.20;
        $this->expectException('BadMethodCallException');
        $this->receipt->subTotal($input, $coupon);
    }

    public function testPostTaxTotal()
    {
        $items = [1, 2, 5, 8];
        $tax = 0.20;
        $coupon = null;
        $receipt = $this->getMockBuilder('App\Receipt')
            ->setMethods(['tax', 'subTotal'])
            ->setConstructorArgs([$this->formatter])
            ->getMock();

        $receipt->expects($this->once()) // expects to call the subTotal() methods once
            ->method('subTotal')
            ->with($items, $coupon)
            ->will($this->returnValue(10.00));

        $receipt->expects($this->once())
            ->method('tax')
            ->with(10.00)
            ->will($this->returnValue(1.00));

        $result = $receipt->postTaxTotal([1, 2, 5, 8], null);
        $this->assertEquals(11.00, $result);
    }

    public function testTax()
    {
        $inputAmount = 10.00;
        $this->receipt->tax = 0.10;

        $output = $this->receipt->tax($inputAmount);
        $this->assertEquals(
            1.00,
            $output,
            'tax calculate = 1.00'
        );
    }
}
