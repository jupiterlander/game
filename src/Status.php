<?php

namespace Jupiterlander;

abstract class Status
{
    const WAITING = 'Waiting';
    const PLAYING = 'Playing';
    const HOLD = 'Hold';
    const BUST = 'Bust';
    const WINNER = 'Winner';
    const LOSER = 'Loser';
}
