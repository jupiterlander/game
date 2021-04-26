<?php

declare(strict_types=1);

namespace Jupiterlander\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Jupiterlander\Yatzy\YatzyGame as YatzyGame;

use function Mos\Functions\{
    renderView,
    url
};

/**
 * Controller for a sample route an controller class.
 */
class Yatzy
{

    public function play(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();
        $yatzyGame = isset($_SESSION['yatzy']) ? unserialize($_SESSION['yatzy']) : new YatzyGame();

        $data = [
            "header" => "Yatzy",
            "message" => "Hey, edit this to do it youreself!",
            "main" => "Play",
            "scoreboard" => $yatzyGame->getScoreboard(),
            "diceValues" => $yatzyGame->getPlayerHand(),
            "rolls" => $yatzyGame->getRolls(),
            "maxRolls" =>  $yatzyGame::MAXROLLS,
        ];

        $body = renderView("layout/yatzy.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function process(): ResponseInterface
    {
        $yatzy = isset($_SESSION['yatzy']) ? unserialize($_SESSION['yatzy']) : new YatzyGame();
        $yatzy->play($_POST['action'], $_POST);
        $_SESSION['yatzy'] = serialize($yatzy);

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/yatzy"));
    }

    public function start(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Yatzy",
            "message" => "Hey, edit this to do it youreself!",
            "main" => "start"
        ];

        $body = renderView("layout/yatzy.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
