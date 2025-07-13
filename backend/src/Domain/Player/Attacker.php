<?php

namespace App\Domain\Player;

class Attacker extends Player
{
    public function __construct(string $name)
    {
        parent::__construct($name, 'Attacker');
    }
}
