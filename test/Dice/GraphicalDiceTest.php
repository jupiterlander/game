<?php

declare(strict_types=1);

namespace Jupiterlander;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Sample.
 */
class GraphicalDiceTest extends TestCase
{
    /**
     * Try to create the dice class.
     */
    public function testCreateTheGraphicalDiceClass()
    {
        $die = new GraphicalDice();
        $this->assertInstanceOf("\Jupiterlander\GraphicalDice", $die);
    }

    /**
     * Check that the getFace method returns correct value.
     */
    public function testGetFace()
    {
        $die = new GraphicalDice();
        $die->roll();
        $face = $die->getFace();
        $this->assertStringContainsStringIgnoringCase("&#x268", $face);
    }

    /**
     * Check that the valueToFace method returns a correct string.
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testValueToFace()
    {
        $this->assertStringContainsStringIgnoringCase("&#x268", GraphicalDice::valueToFace(1));
    }
}
