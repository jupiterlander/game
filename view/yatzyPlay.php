<?php

declare(strict_types=1);

// Variables from controller
$header = $header ?? null;
$message = $message ?? null;

$scoreboard = $scoreboard ?? null;
$diceValues = $diceValues ?? null;
$rolls = $rolls ?? null;
$maxRolls = $maxRolls ?? null;

// Helper-variables for shorter syntax
$rollsLeft = $maxRolls - $rolls;
$firstRoll = ($rolls == 0);
$scoreboardFirstBlock = $scoreboard["firstBlock"];
$sum = $scoreboard["firstTotal"]["score"];
$total = $scoreboard["Total"]["score"];
$gameover = !is_null($total);



?><h1><?= $header ?></h1>
<div>
    <h2>A simple Yatzy game.</h2>
    <p>Click on die to hold and click on Ones..Sixes to select score. Bonus for sum > 44.</p>

</div>

<div style="display: inline-block">
<form method="POST">
<fieldset class="large">

    <?php foreach (array_keys($diceValues) as $index) {
        $name = "hold" . "[" . $index . "]";
        ?>
        <div style="height: 3rem">
        <input type="checkbox" id="die-<?= $name ?>" name="<?= $name ?>" value="roll" style="visibility:<?= $firstRoll ? 'hidden' : 'visible' ?>">
        <label for="die-<?= $name ?>">&#<?= $firstRoll ? 9633 : 9855 + $diceValues[$index] ?>;</label>
    </div>
    <?php } ?>

    <p>Rolls left: <?= $rollsLeft ?></p>
    <input style="width: 10rem; padding: 0.5rem" type="submit" name="action" value="<?= $gameover ? 'New game' : 'Roll' ?>" <?= $rollsLeft ? '' : 'disabled' ?>>
</fieldset>
</form>
</div>


<div style="display: inline-block">
<form method="POST">
<fieldset  <?= $rollsLeft > 2 ? "disabled" : null ?>>
<table>
    <tr>
        <th colspan=3 style="background: lightgray;">Scoreboard</th>
    </tr>

    <?php foreach (array_keys($scoreboardFirstBlock) as $key) {
        $value = $scoreboardFirstBlock[$key]["score"] === 0 ? 'X' : $scoreboardFirstBlock[$key]["score"]; ?>

        <tr>
            <td><input type="radio" id ="score-<?= $key ?>" name="scoreboard" value="<?= $key ?>" <?= $value ? "disabled" : null  ?>></th>
            <td  <?= $value ? 'style="text-decoration: line-through"' : null  ?>><label for="score-<?= $key ?>"><?= $key ?></label></td>
            <td><?= $value ?></td>
        </tr> 
    <?php } ?>
        <tr>
            <th colspan=2>Sum: </th>
            <td><?= $sum ?></td>
        </tr>
        <tr>
            <th colspan=2>Bonus: </th>
            <td><?= $scoreboard["firstBonus"]["score"] ?></td>
        </tr>
        <tr  style="background: lightgray;">
            <th colspan=2>Total: </th>
            <td><?= $total ?></td>
        </tr>
</table>

    <input style="width: 10rem; padding: 0.5rem" type="submit" name="action" value="setscore" <?= false ? 'disabled' : '' ?>>
</fieldset>
</form>
</div>
<hr>

