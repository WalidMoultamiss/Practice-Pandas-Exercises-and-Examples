<?php

namespace App\Domain\Training;

class Physical extends Training
{
    public function __construct(string $name, \DateTime $date)
    {
        parent::__construct($name, 'Physical', $date);
    }
}
