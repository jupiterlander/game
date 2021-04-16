<?php

declare(strict_types=1);

use Jupiterlander\DiceHand as DiceHand;
use Jupiterlander\DicePlayer as Diceplayer;
use Jupiterlander\DiceGame21 as Game;
use Jupiterlander\Status as Status;

$header = $header ?? null;
$message = $message ?? null;
$winner = null;
$action = $_POST['action'] ?? null;

$game = isset($_SESSION['game']) ? unserialize($_SESSION['game']) : new Game(intval($_POST['dices']) ?? 2);

switch ($action) {
    case 'Rematch':
        $game->newGame();
        break;
    case 'Reset score':
        $game->resetScore();
        break;
    case Status::HOLD:
        $game->getPlayer()->setStatus(Status::HOLD);
        $game->getComputer()->setStatus(Status::PLAYING);
        break;
    case 'dices':
        $game->getPlayer()->setStatus(Status::PLAYING);
        break;
    case 'Roll':
        $winner = $game->play();
        break;
}

$winner = $game->getWinner();

$_SESSION['game'] = serialize($game);

// var_dump($_SESSION['game']);


?><h1><?= $header ?></h1>
<p><?= $message ?></p>

<h2>Scoreboard:</h2>

<p>Player: <?= $game->getPlayerScore(); ?></p>
<p>Computer: <?= $game->getComputerScore(); ?></p>


<p  class="large"><span style="text-decoration:<?= $game->getPlayer()->getStatus() == Status::PLAYING ? "underline" : ""; ?>" >Player: </span><?= $game->getPlayer()->getTotal(); ?> <?= $game->getPlayer()->getGraphicalRolls(); ?>  </p>
<p  class="large"><span style="text-decoration:<?= $game->getComputer()->getStatus() == Status::PLAYING ? "underline" : ""; ?>" >Computer: </span><?= $game->getComputer()->getTotal(); ?>  <?= $game->getComputer()->getGraphicalRolls(); ?></p>
<p  class="large">Winner: <?= $game->getWinner(); ?></p>



<form method="POST">
<input style="width: 10rem; padding: 0.5rem" type="submit" name="action" value="Roll" <?= $winner ? 'disabled' : '' ?>>
<input style="width: 10rem; padding: 0.5rem" type="submit" name="action" value="<?= $winner ? 'Rematch' : Status::HOLD ?>" <?= ($game->getPlayer()->getStatus() == Status::HOLD && !$winner) ? 'disabled' : ''; ?>>
<input style="width: 10rem; padding: 0.5rem" type="submit" name="action" value="Reset score" <?= $winner ? '' : 'disabled'; ?>>
</form>

