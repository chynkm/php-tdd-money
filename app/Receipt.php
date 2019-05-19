<?php

namespace App;

use \BadMethodCallException;

/**
 *
 */
class Receipt
{
    public function total(array $items = [], $coupon)
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

    public function tax($amount, $tax)
    {
        return $amount * $tax;
    }

    public function postTaxTotal($items, $tax, $coupon)
    {
        $subTotal = $this->total($items, $coupon);

        return $subTotal + $this->tax($subTotal, $tax);
    }
}
