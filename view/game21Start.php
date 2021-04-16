<?php

declare(strict_types=1);

use Jupiterlander\DiceGame21 as DiceGame;

?><h1><?= $header ?></h1>

<p><?= $message ?></p>
<p>Start the game by choosing one or two dices</p>

<form method="POST">
<input type="hidden" name="action" value="dices">
<input type="submit" name="dices" value="1">
<input type="submit" name="dices" value="2">
</form>
