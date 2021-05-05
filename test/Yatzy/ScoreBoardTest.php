<?php

declare(strict_types=1);

namespace Jupiterlander\Yatzy;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Sample.
 */
class ScoreBoardTest extends TestCase
{
    /**
     * Try to create the dice class.
     */
    public function testCreateTheScoreBoardClass()
    {
        $scoreboard = new ScoreBoard();
        $this->assertInstanceOf("\Jupiterlander\Yatzy\ScoreBoard", $scoreboard);
    }


    /**
     * Check that it works to play.
     */
    public function testSetScore()
    {
        $scoreboard = new ScoreBoard();
        $scoreboard->setScore("Sixes", 36);
        $this->assertEquals(36, $scoreboard->getScore()["firstTotal"]["score"]);

        $scoreboard->setScore("Fives", 5);
        $scoreboard->setScore("Fours", 4);
        $scoreboard->setScore("Threes", 3);
        $scoreboard->setScore("Twos", 2);
        $scoreboard->setScore("Ones", 1);

        $this->assertEquals(36 + 5 + 4 + 3 + 2 + 1 + $scoreboard::BONUS, $scoreboard->getScore()["Total"]["score"]);
    }
}
