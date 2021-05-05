<?php

namespace Jupiterlander\Yatzy;

class YatzyGame
{

    const ROLL = "roll";
    const HOLD = "hold";
    const SETSCORE = "setscore";
    const MAXROLLS = 3;

    /**
     * Properties
     */
    private $player = null;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->player = new YatzyPlayer();
    }


    public function play(?string $action, ?array $arg)
    {
        $_SESSION['tmp'] = $_POST;
        switch ($action) {
            case 'Roll':
                $this->player->rollHand($this->holdToRollFix($arg[self::HOLD] ?? array()));
                break;
            case 'setscore':
                if (isset($arg["scoreboard"])) {
                    $this->player->setScoreBoard($arg["scoreboard"]);
                    $this->player->setRolls(0);
                }
                break;
            case 'New game':
                $this->player = new YatzyPlayer();
                break;
        }
    }

    /**
     * Functions as Public 'API'
     */
    public function getPlayerHand()
    {
        return $this->player->getDiceHand();
    }

    public function getRolls()
    {
        return $this->player->getRolls();
    }


    public function getScoreboard()
    {
        return $this->player->getScoreBoard()->getScore();
    }

    /**
     * A fix for hold to roll checkbox
     */
    private function holdToRollFix(array $arr)
    {
        $holdToRoll = array();

        for ($i = 0; $i < 5; $i++) {
            array_key_exists($i, $arr) ? null : ($holdToRoll[$i] = self::ROLL);
        }

        return $holdToRoll;
    }
}
