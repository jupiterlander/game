<?php

declare(strict_types=1);

use Jupiterlander\Yatzy\YatzyGame as Yatzy;

?><h1><?= $header ?></h1>

<p><?= $message ?></p>
<p>Start the game by choosing one or two Players</p>

<form method="POST">
<input type="hidden" name="action" value="dices">
<input type="submit" name="dices" value="1">
<input type="submit" name="dices" value="2">
</form>
