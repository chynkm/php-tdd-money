<?php

namespace App;

/**
 *
 */
class Formatter
{
    public function currencyAmt($input)
    {
        return round($input, 2);
    }
}
