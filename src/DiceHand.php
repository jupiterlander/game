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
    public function rollHand(): void
    {
        foreach ($this->dices as &$dice) {
            $dice->roll();
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
