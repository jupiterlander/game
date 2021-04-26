<?php

namespace Jupiterlander\Yatzy;

class ScoreBoard
{
    const BONUSLIMIT = 40;
    const BONUS = 50;

    /**
     * Properties
     */
    private $scores = [
        "firstBlock" => [
            "Ones" => ["score" => null, "dieValue" => 1],
            "Twos" => ["score" => null, "dieValue" => 2],
            "Threes" => ["score" => null, "dieValue" => 3],
            "Fours" => ["score" => null, "dieValue" => 4],
            "Fives" => ["score" => null, "dieValue" => 5],
            "Sixes" => ["score" => null, "dieValue" => 6],
        ],
        "firstBonus" => ["score" => null, "bonus" => self::BONUS, "limit" => self::BONUSLIMIT],
        "firstTotal" => ["score" => null],
        "Total" => ["score" => null],
    ];

    //private $name = null;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Get the value of scores
     */
    public function getScore()
    {
        return $this->scores;
    }

    /**
     * Set the value of scores
     *
     * @return  self
     */
    public function setScore($key, $value)
    {
        $this->scores["firstBlock"][$key]["score"] = $value;
        $this->scores["firstTotal"]["score"] += $value;
        $this->setTotal();
        return $this;
    }

    private function firstBlockFull()
    {
        $check = false;
        foreach ($this->scores["firstBlock"] as $score) {
            $check = $check || ($score["score"] === null);
        }
        return !$check;
    }

    private function setTotal()
    {
        $firstTotal = $this->scores["firstTotal"]["score"];

        if ($this->firstBlockFull()) {
            $this->scores["firstBonus"]["score"] = ($firstTotal >= self::BONUSLIMIT) ? self::BONUS : 0;
            $this->scores["Total"]["score"] = $firstTotal + $this->scores["firstBonus"]["score"];
        }
    }

    public function toDieValue(string $key)
    {
        return $this->scores["firstBlock"][$key]["dieValue"];
    }

    public function getTotalScore(): int
    {
        $total = 0;

        foreach ($this->scores["firstBlock"] as $score) {
            $total += $score['score'];
        }
        return $total;
    }
}
