<?php

declare(strict_types=1);

namespace Jupiterlander\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\renderView;

/**
 * Controller for a sample route an controller class.
 */
class Game21
{

    public function play(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Game21",
            "message" => "",
            "main" => "play"
        ];

        $body = renderView("layout/game21.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function start(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Game21",
            "message" => "",
            "main" => "start"
        ];

        $body = renderView("layout/game21.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
