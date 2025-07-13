<?php

namespace App\Domain\Player;

class Defender extends Player
{
    public function __construct(string $name)
    {
        parent::__construct($name, 'Defender');
    }
}
