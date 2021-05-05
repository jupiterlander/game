<?php

declare(strict_types=1);

namespace Jupiterlander\Yatzy;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Sample.
 */
class YatzyGameTest extends TestCase
{
    /**
     * Try to create the dice class.
     */
    public function testCreateTheYatzyGameClass()
    {
        $game = new YatzyGame();
        $this->assertInstanceOf("\Jupiterlander\Yatzy\YatzyGame", $game);
    }


    /**
     * Check that it works to play.
     */
    public function testPlay()
    {
        $game = new YatzyGame();
        $game->play('Roll', []);
        $result = $game->getPlayerHand();

        $this->assertContainsOnly('integer', $result);

        $scoreboard = $game->getScoreBoard();
        $this->assertEquals(null, $scoreboard['firstBlock']['Ones']['score']);

        $game->play('setscore', ['scoreboard' => 'Ones']);
        $scoreboard = $game->getScoreBoard();

        $this->assertIsInt($scoreboard['firstBlock']['Ones']['score']);
        $this->assertGreaterThanOrEqual(0, $scoreboard['firstTotal']['score']);

        $game->play('New game', []);

        $this->assertNottrue($scoreboard === $game->getScoreBoard());
        $this->assertEquals(null, $game->getScoreBoard()['firstTotal']['score']);
        $this->assertEquals(0, $game->getRolls());
    }
}
