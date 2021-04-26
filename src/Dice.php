<?php

namespace Jupiterlander;

class Dice
{
    /**
     * Properties
     */
    private ?int $lastRoll = null;
    private int $faces = 0;


    /**
     * Constructor
     */
    public function __construct(int $faces = 6)
    {
        $this->faces = $faces;
    }


      /**
     * Roll the dice
     *
     * @return int
     */
    public function roll(): int
    {
        $this->lastRoll = rand(1, $this->faces);
        return $this->lastRoll;
    }


    /**
     * Roll the dice
     *
     * @return ?int
     */
    public function getLastRoll(): ?int
    {
        return $this->lastRoll;
    }
}
