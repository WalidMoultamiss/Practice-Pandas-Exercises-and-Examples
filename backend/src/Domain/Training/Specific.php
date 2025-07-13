<?php

namespace App\Domain\Training;

class Specific extends Training
{
    public function __construct(string $name, \DateTime $date)
    {
        parent::__construct($name, 'Specific', $date);
    }
}
