<?php

namespace App;

use \BadMethodCallException;

/**
 *
 */
class Receipt
{
    public function __construct($formatter)
    {
        $this->formatter = $formatter;
    }

    public function subTotal(array $items = [], $coupon)
    {
        if ($coupon > 1.00) {
            throw new BadMethodCallException("Coupon must be <= 1.00", 1);
        }

        $sum = array_sum($items);
        if (! is_null($coupon)) {
            return $sum - ($sum * $coupon);
        }

        return $sum;
    }

    public function tax($amount)
    {
        return $this->formatter->currencyAmt($amount * $this->tax);
    }

    public function postTaxTotal($items, $coupon)
    {
        $subTotal = $this->subTotal($items, $coupon);

        return $subTotal + $this->tax($subTotal);
    }
}
