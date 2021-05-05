<?php

declare(strict_types=1);

namespace Jupiterlander;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Sample.
 */
class DicePlayerTest extends TestCase
{
    /**
     * Try to create the dice class.
     */
    public function testCreateTheDicePlayerClass()
    {
        $dicePlayer = new DicePlayer();
        $this->assertInstanceOf("\Jupiterlander\DicePlayer", $dicePlayer);
    }

    /**
     * Check that the rollHand method returns correct value.
     */
    public function testRollHand()
    {
        $dicePlayer = new DicePlayer();
        $result = $dicePlayer->rollHand();

        $this->assertIsArray($result);
    }

    /**
     * Check that the getGraphicalRolls method returns a correct string.
     */
    public function testGetGraphicalRolls()
    {
        $dicePlayer = new DicePlayer();
        $result = $dicePlayer->rollHand();
        $result = $dicePlayer->getGraphicalRolls();

        $this->assertStringContainsStringIgnoringCase("&#x268", $result);
    }

    /**
     * Check that the getTotal method returns correct value.
     */
    public function testGetTotal()
    {
        $dicePlayer = new DicePlayer();
        $this->assertEquals(0, $dicePlayer->getTotal());

        $dicePlayer->rollHand();
        $this->assertGreaterThan(0, $dicePlayer->getTotal());
    }

     /**
     * Check that the setStatus and getStatus method returns correct value.
     */
    public function testSetStatus()
    {
        $dicePlayer = new DicePlayer();
        $this->assertIsString($dicePlayer->getStatus());

        $dicePlayer->setStatus(Status::WAITING);
        $this->assertEquals(Status::WAITING, $dicePlayer->getStatus());
    }

    /**
     * Check that the getRolls method returns correct value.
     */
    public function testGetRolls()
    {
        $dicePlayer = new DicePlayer();
        $dicePlayer->rollHand();
        $result = $dicePlayer->getRolls();

        $this->assertContainsOnly('integer', $result);
    }
}
