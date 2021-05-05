<?php

declare(strict_types=1);

namespace Jupiterlander\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Sample.
 */
class ControllerGame21Test extends TestCase
{
    /**
     * Try to create the yatzy controller class.
     */
    public function testCreateTheGame21ControllerClass()
    {
        $controller = new Game21();
        $this->assertInstanceOf("\Jupiterlander\Controller\Game21", $controller);
    }

    /**
     * Check that the controller returns a response.
     * @runInSeparateProcess
     */
    public function testGame21ControllerReturnsResponse()
    {
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";

        $res = $controller->play();
        $this->assertInstanceOf($exp, $res);

        $res = $controller->start();
        $this->assertInstanceOf($exp, $res);
    }
}
