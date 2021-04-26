<?php

namespace Jupiterlander\Yatzy;

use Jupiterlander\DiceHand as DiceHand;
use Jupiterlander\Status as Status;
use Jupiterlander\Yatzy\ScoreBoard;

class YatzyPlayer
{
    const WAITING = 'waiting';

    /**
     * Properties
     */
    private $diceHand = null;
    private $rolls = null;
    private $scoreboard = null;


    private string $status;


    /**
     * Constructor
     */
    public function __construct(int $dices = 5, int $faces = 6, int $rolls = 0, string $status = Status::WAITING)
    {
        $this->diceHand = new DiceHand($dices, $faces);
        $this->rolls = $rolls;
        $this->status = $status;
        $this->scoreboard = new ScoreBoard();
    }


  /**
     * Roll dice/dices in hand and update $rolls
     *
     * @return array
     */
    public function rollHand(array $diceToRoll = null): array
    {
        $this->diceHand->rollHand($diceToRoll);
        $this->rolls++;
        //$this->rolls = array_merge($this->rolls, $this->diceHand->getHandValues());

        return $this->diceHand->getHandValues();
    }


    /**
     * Return graphical representation string of rolls
     *
     * @return string
     */
    public function getGraphicalRolls(): string
    {
        $result = "";

        foreach ($this->rolls as $value) {
            $result .= $this->diceHand->valueToFace($value);
        }

        return $result;
    }



    /**
     * Get the total
     *
     * @return int
     */
    public function getTotal(): int
    {
        $total = 0;

        foreach ($this->rolls as $value) {
            $total += $value;
        }
        return $total;
    }


    /**
     * Get the value of status
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  void
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * Get the value of rolls
     */
    public function getRolls(): int
    {
        return $this->rolls;
    }


    /**
     * Get properties
     */
    public function getDiceHand()
    {
        return $this->diceHand->getHandValues();
    }

    /**
     * Get the value of scoreboard
     */
    public function getScoreboard()
    {
        return $this->scoreboard;
    }

    /**
     * Set the value of scoreboard
     *
     * @return  self
     */
    public function setScoreboard(string $key)
    {
        $dieValue = $this->scoreboard->toDieValue($key);
        $total = 0;
        $score = $this->diceHand->getHandValues();

        foreach ($score as $value) {
            $total += ($dieValue == $value) ? $value : 0;
        }

        $this->scoreboard->setScore($key, $total);

        return $this;
    }

    /**
     * Set the value of rolls
     *
     * @return  self
     */
    public function setRolls($rolls)
    {
        $this->rolls = $rolls;

        return $this;
    }
}
