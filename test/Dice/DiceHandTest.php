<?php

declare(strict_types=1);

namespace Jupiterlander;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Sample.
 */
class DiceHandTest extends TestCase
{
    /**
     * Try to create the dice class.
     */
    public function testCreateDiceHandClass()
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\Jupiterlander\DiceHand", $diceHand);
    }

    /**
     * Checks the rollHand method.
     * @SuppressWarnings(PHPMD.LongVariable)
     */
    public function testRollHand()
    {
        $diceHand = new DiceHand();

        $diceHand->rollHand();
        $valFirst = $diceHand->getHandValues();
        $diceHand->rollHand();
        $valSecond = $diceHand->getHandValues();

        $this->assertNotEquals($valFirst, $valSecond);

        $diceHand->rollHand([0 => "roll", 3 => "roll", 5 => "roll"]);
        $valThird = $diceHand->getHandValues();

        $valFilteredRollThird = array($valThird[0], $valThird[3], $valThird[5]);
        $valFilteredRollSecond = array($valSecond[0], $valSecond[3], $valSecond[5]);

        $this->assertNotEquals($valFilteredRollThird, $valFilteredRollSecond);

        $valFilteredNotRollThird = array($valThird[1], $valThird[2], $valThird[4]);
        $valFilteredNotRollSecond = array($valSecond[1], $valSecond[2], $valThird[4]);

        $this->assertEquals($valFilteredNotRollThird, $valFilteredNotRollSecond);
    }


     /**
     * Check that the showHand method returns correct value.
     */
    public function testShowHand()
    {
        $diceHand = new DiceHand();
        $diceHand->roll();
        $hand = $diceHand->showHand();

        $this->assertStringContainsStringIgnoringCase("&#x268", $hand);
    }
}
