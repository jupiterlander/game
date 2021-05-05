<?php

declare(strict_types=1);

namespace Jupiterlander;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Sample.
 */
class DiceTest extends TestCase
{
    /**
     * Try to create the dice class.
     */
    public function testCreateTheDiceClass()
    {
        $die = new Dice();
        $this->assertInstanceOf("\Jupiterlander\Dice", $die);
    }

    /**
     * Check that the getFaces method returns correct value.
     */
    public function testGetFacesResponse()
    {
        $die = new Dice();
        $faces = $die->getFaces();
        $this->assertEquals($faces, 6);


        $die = new Dice(1);
        $faces = $die->getFaces();
        $this->assertEquals($faces, 1);
    }

    /**
     * Check that the controller returns a response.
     */
    public function testGetLastRoll()
    {
        $die = new Dice();
        $result = $die->roll();
        $lastRoll = $die->getLastRoll();

        $this->assertEquals($result, $lastRoll);
    }
}
