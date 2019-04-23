<?php

namespace App\Classes;

use App\Classes\Dollar;
use App\Classes\Franc;

abstract class Money
{
    protected $amount;

    public function equals(Money $money)
    {
        return $this->amount == $money->amount
            && get_class($this) == get_class($money);
    }

    public static function dollar($amount)
    {
        return new Dollar($amount);
    }

    public static function franc($amount)
    {
        return new Franc($amount);
    }

    abstract function times($multiplier);
}
