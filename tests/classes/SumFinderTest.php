<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Classes\SumFinder;

class SumFinderTest extends TestCase
{
    public function testSumFinder()
    {
        $input = array(0, 1, 2, 3, 6, 7, 8, 9, 11, 12, 14);
        $result = array('group'=>'6, 7, 8, 9', 'sum'=> 30);

        $sumFinder = new SumFinder($input);
        $this->assertEquals($result, $sumFinder->findSum($input));
    }

    public function testCompareArrays()
    {
        $array1 = array(0,1,2,3);
        $array2 = array(6,7,8,9);

        $sumFinder = new SumFinder();
        // $array2 > $array1
        $this->assertEquals(-1, $sumFinder->compareArrays($array1,$array2));
        // $array1 < $array2
        $this->assertEquals(1, $sumFinder->compareArrays($array2,$array1));
        // $array2 = $array2
        $this->assertEquals(0, $sumFinder->compareArrays($array2,$array2));
    }
}
