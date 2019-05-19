<?php

namespace App;

/**
 *
 */
class Receipt
{

    public function total(array $items = [])
    {
        return array_sum($items);
    }
}
