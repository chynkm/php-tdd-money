<?php

namespace App\Classes;

use App\Classes\Dollar;
use App\Classes\Franc;

abstract class Money
{
    protected $amount, $currency;

    public function __construct($amount, $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function equals(Money $money)
    {
        return $this->amount == $money->amount
            && get_class($this) == get_class($money);
    }

    public static function dollar($amount)
    {
        return new Dollar($amount, 'USD');
    }

    public static function franc($amount)
    {
        return new Franc($amount, 'CHF');
    }

    abstract function times($multiplier);

    public function currency()
    {
        return $this->currency;
    }
}
