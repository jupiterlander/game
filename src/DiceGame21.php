<?php

namespace Jupiterlander;

use Jupiterlander\DicePlayer as DicePlayer;
use Jupiterlander\Status as Status;

class DiceGame21
{
    /**
     * Properties
     */
    private DicePlayer $player;
    private DicePlayer $computer;

    private int $playerScore;
    private int $computerScore;

    private int $dices;
    private int $faces;

    private ?string $winner = null;

    /**
     * Constructor
     */
    public function __construct(int $dices = 2, int $faces = 6, $playerScore = 0, $computerScore = 0)
    {
        $this->dices = $dices;
        $this->faces = $faces;

        $this->player = new DicePlayer($dices, $faces);
        $this->computer = new DicePlayer($dices, $faces, array(), Status::WAITING);

        $this->playerScore = $playerScore;
        $this->computerScore = $computerScore;
    }


    /**
     * Get dicerolls graphical
     *
     * @return string
     */
    public function getGraphicalRolls(): string
    {
        return $this->player->getGraphicalRolls();
    }



    /**
     * Play
     *
     * @return ?string
     */
    public function play(): ?string
    {

        if ($this->player->getStatus() == Status::PLAYING) {
            $this->player->rollHand();

            if ($this->player->getTotal() > 21) {
                $this->player->setStatus(Status::BUST);
                $this->winner = 'computer';
                $this->computerScore++;
            }
        } else {
            $this->computer->rollHand();

            if ($this->computer->getTotal() > 21) {
                $this->computer->setStatus(Status::BUST);
                $this->winner = 'player';
                $this->playerScore++;
            } else if ($this->computer->getTotal() > $this->player->getTotal()) {
                $this->winner = 'computer';
                $this->computerScore++;
            }
        }
        return $this->winner;
    }




    /**
     * Setuopt new game
     */
    public function newGame()
    {
        $this->player = new DicePlayer($this->dices, $this->faces, array(), Status::PLAYING);
        $this->computer = new DicePlayer($this->dices, $this->faces, array(), Status::WAITING);
        $this->winner = null;
    }


    /**
     * Get
     */
    // public function getWinner()
    // {
    //     $winner = null;

    //     if ($this->player->getStatus() == Status::BUST) {
    //         $winner = 'Computer';
    //         $this->computerScore = $this->computerScore + 1;
    //     } else if ($this->computer->getStatus() == Status::BUST) {
    //         $winner = 'Player';
    //         $this->computerScore++;
    //     } else if ($this->player->getStatus() == Status::HOLD && $this->computer->getTotal() > $this->player->getTotal()) {
    //         $winner = 'Computer';
    //         $this->playerScore++;
    //     }

    //     return $winner;
    // }



    /**
     * Get
     */
    public function resetScore()
    {
        $this->playerScore = 0;
        $this->computerScore = 0;
    }


    /**
     * Get properties
     */
    public function getPlayer()
    {
        return $this->player;
    }

    public function getWinner()
    {
        return $this->winner;
    }


    /**
     * Get the value of computer
     */
    public function getComputer()
    {
        return $this->computer;
    }

    /**
     * Get the value of playerScore
     */
    public function getPlayerScore()
    {
        return $this->playerScore;
    }

    /**
     * Get the value of computerScore
     */
    public function getComputerScore()
    {
        return $this->computerScore;
    }
}
