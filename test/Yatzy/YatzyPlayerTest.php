<?php

declare(strict_types=1);

namespace Jupiterlander\Yatzy;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Sample.
 */
class YatzyPlayerTest extends TestCase
{
    /**
     * Try to create the dice class.
     */
    public function testCreateTheYatzyPlayerClass()
    {
        $yatzyplayer = new YatzyPlayer();
        $this->assertInstanceOf("\Jupiterlander\Yatzy\YatzyPlayer", $yatzyplayer);
    }
}
