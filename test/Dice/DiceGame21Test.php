<?php

declare(strict_types=1);

namespace Jupiterlander;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Sample.
 */
class DiceGame21Test extends TestCase
{
    /**
     * Try to create the dice class.
     */
    public function testCreateTheDiceGame21Class()
    {
        $game = new DiceGame21();
        $this->assertInstanceOf("\Jupiterlander\DiceGame21", $game);
    }

    /**
     * Check that the getGraphicalRolls method returns a correct string.
     */
    public function testGetGraphicalRolls()
    {
        $game = new DiceGame21();
        $game->getPlayer()->setStatus(Status::PLAYING);
        $result = $game->play();
        $result = $game->getGraphicalRolls();

        $this->assertStringContainsStringIgnoringCase("&#x268", $result);
    }

    /**
     * Check that it works to play.
     */
    public function testPlay()
    {
        $game = new DiceGame21();
        $game->getPlayer()->setStatus(Status::PLAYING);
        $result = $game->play();

        $this->assertEquals(null, $result);

        while ($game->getPlayer()->getStatus() == Status::PLAYING) {
            $result = $game->play();
        }

        $this->assertEquals('computer', $result);

        $game = new DiceGame21();
        $game->getPlayer()->setStatus(Status::HOLD);
        $result = $game->play();

        $this->assertEquals('computer', $result);
    }


    /**
     * Try to create a new game.
     */
    public function testNewGame()
    {
        $game = new DiceGame21();
        $player = $game->getPlayer();
        $computer = $game->GetComputer();
        $game->getPlayer()->setStatus(Status::HOLD);
        $game->play();
        $game->newGame();

        $this->assertNotEquals($player, $game->getPlayer());
        $this->assertNotEquals($computer, $game->GetComputer());
        $this->assertEquals(null, $game->getWinner());
    }

    /**
     * Try to reset score.
     */
    public function testResetScore()
    {
        $game = new DiceGame21();
        $game->resetScore();

        $this->assertEquals(0, $game->getPlayerScore());
        $this->assertEquals(0, $game->getComputerScore());
    }
}
