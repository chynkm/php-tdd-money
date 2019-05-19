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
        $output = $this->receipt->total($input);
        $this->assertEquals(
            15,
            $output,
            'Total sum should be 15'
        );
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
