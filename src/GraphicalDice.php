<?php

namespace Jupiterlander;

class GraphicalDice extends Dice
{
    /**
     * Return the dice face
     *
     * @return string
     */
    public function getFace(): string
    {
        return html_entity_decode("&#x268" . (intval($this->getLastRoll()) - 1));
    }


    /**
     * Return the dice face for value
     *
     * @return string
     */
    public static function valueToFace(int $value): string
    {
        return html_entity_decode("&#x268" . (intval($value) - 1));
    }
}
