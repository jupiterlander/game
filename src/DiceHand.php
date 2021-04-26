<?php

namespace Jupiterlander;

use Jupiterlander\GraphicalDice as Dice;

class DiceHand extends Dice
{
    /**
     * Properties
     */
    private array $dices = array();


    /**
     * Constructor
     */
    public function __construct(int $dices = 6, int $faces = 6)
    {
        for ($i = 0; $i < $dices; $i++) {
            $this->dices[] = new Dice($faces);
        }
    }


       /**
     * Roll the dices in hand
     *
     * @return void
     */
    public function rollHand(?array $diceToRoll = null): void
    {
        // var_dump($this->dices);
        //echo "<pre>".print_r($diceToRoll,true).print_r($this->dices,true). "</pre>";
        if ($diceToRoll) {
            foreach (array_keys($diceToRoll) as $index) {
                $this->dices[$index]->roll();
            }
        } else {
            foreach ($this->dices as &$dice) {
                $dice->roll();
            }
        }
    }


    public function updateHoldDice(array $hold)
    {
        $count = count($this->dices);

        for ($i = 0; $i < $count; $i++) {
            $hold = $hold[$i] ?? false;
            $this->dices[$i]->setHold($hold);
        }
    }


    /**
     * Get values
     *
     * @return array
     */
    public function getHandValues(): array
    {
        $result = array();

        foreach ($this->dices as &$dice) {
            $result[] = $dice->getLastroll();
        }

        return $result;
    }


    /**
     * Show the dices in hand
     *
     * @return string
     */
    public function showHand(): string
    {
        $result = '';

        foreach ($this->dices as &$dice) {
            $result .= $dice->getFace();
        }

        return $result;
    }
}
