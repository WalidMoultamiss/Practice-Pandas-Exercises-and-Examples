<?php

namespace App\Domain\Training;

class Tactical extends Training
{
    public function __construct(string $name, \DateTime $date)
    {
        parent::__construct($name, 'Tactical', $date);
    }
}
