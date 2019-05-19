<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Formatter;

/**
 *
 */
class FormatterTest extends TestCase
{
    protected $formatter;

    public function setUp(): void
    {
        $this->formatter = new Formatter;
    }

    public function tearDown(): void
    {
        unset($this->formatter);
    }

    /**
     * @dataProvider provideCurrencyAmt
     */
    public function testCurrencyAmount($input, $expected, $msg)
    {
        $this->assertSame(
            $expected,
            $this->formatter->currencyAmt($input),
            $msg
        );
    }

    public function provideCurrencyAmt()
    {
        return [
            [1, 1.00, '1 should be 1.00'],
            [1.1, 1.10, '1.1 should be 1.10'],
            [1.11, 1.11, '1.11 should be 1.11'],
            [1.111, 1.11, '1.111 should be 1.11 '],
        ];
    }
}
