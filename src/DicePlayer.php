<?php

namespace Jupiterlander;

use Jupiterlander\DiceHand as DiceHand;
use Jupiterlander\Status as Status;
use Jupiterlander\GraphicalDice as Dice;

class DicePlayer
{
    /**
     * Properties
     */
    private $diceHand = null;
    private $rolls = null;

    private string $status;


    /**
     * Constructor
     */
    public function __construct(int $dices = 2, int $faces = 6, array $rolls = array(), string $status = Status::WAITING)
    {
        //$this->diceHand = new DiceHand(...$this->createDiceArr($dices, $faces)) ;
        $this->diceHand = new DiceHand($dices, $faces);
        $this->rolls = $rolls;
        $this->status = $status;
    }


     /**
     * Helper function to create array of dice objects
     *
     * @return array
     */
   /*  private function createDiceArr($length, $faces): array
    {
       $arr = array();

       for ($i = 0; $i < $length; $i++) {
           $arr[] = new Dice($faces);
       }
        return $arr;
    } */


  /**
     * Roll dice/dices in hand and update $rolls
     *
     * @return array
     */
    public function rollHand(): array
    {
        $this->diceHand->rollHand();
        $this->rolls = array_merge($this->rolls, $this->diceHand->getHandValues());

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
    public function getRolls()
    {
        return $this->rolls;
    }
}
