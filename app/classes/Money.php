<?php

namespace App\Classes;

class Money
{
    protected $amount;

    public function equals(Money $money)
    {
        return $this->amount == $money->amount;
    }

    public function dollar($amount)
    {
        $this->amount = $amount;
        return new Dollar($amount);
    }
}