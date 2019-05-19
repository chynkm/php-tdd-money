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

    public function testTotal()
    {
        $input = [0, 2, 5, 8];
        $coupon = null;
        $output = $this->receipt->total($input, $coupon);
        $this->assertEquals(
            15,
            $output,
            'Total sum should be 15'
        );
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
}
