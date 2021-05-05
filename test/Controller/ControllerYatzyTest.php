<?php

declare(strict_types=1);

namespace Jupiterlander\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Sample.
 */
class ControllerYatzyTest extends TestCase
{
    /**
     * Try to create the yatzy controller class.
     */
    public function testCreateTheYaztyControllerClass()
    {
        $controller = new Yatzy();
        $this->assertInstanceOf("\Jupiterlander\Controller\Yatzy", $controller);
    }

    /**
     * Check that the controller returns a response.
     * @runInSeparateProcess
     */
    public function testYatzyControllerReturnsResponse()
    {
        $controller = new Yatzy();

        $exp = "\Psr\Http\Message\ResponseInterface";

        $res = $controller->process();
        $this->assertInstanceOf($exp, $res);

        $res = $controller->play();
        $this->assertInstanceOf($exp, $res);

        $res = $controller->start();
        $this->assertInstanceOf($exp, $res);
    }
}
