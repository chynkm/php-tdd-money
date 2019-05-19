<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

/**
* @backupGlobals enabled
*/
class GlobalTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        $config = new stdClass();
        $config->date = new DateTime("today");
        $GLOBALS['config'] = $config;
    }

    public function testToday()
    {
        $today  = new DateTime("today");
        $this->assertTrue($today == $GLOBALS['config']->date);
        //not affecting global state, backupGlobals is enabled
        $GLOBALS['config']->date = new DateTime("tomorrow");
    }

    /**
    * @backupGlobals disabled
    */
    public function testTomorrow()
    {
        $tomorrow  = new DateTime("tomorrow");
        $this->assertTrue($tomorrow > $GLOBALS['config']->date);
        //will change global value
        $GLOBALS['config']->date = $tomorrow;
    }

    public function testTomorrowIsolated()
    {
        $tomorrow  = new DateTime("tomorrow");
        $this->assertEquals($tomorrow, $GLOBALS['config']->date);
    }
}
