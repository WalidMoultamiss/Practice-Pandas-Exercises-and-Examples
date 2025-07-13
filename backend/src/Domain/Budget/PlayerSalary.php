<?php

namespace App\Domain\Budget;

use App\Domain\Player\Player;

class PlayerSalary implements Expense
{
    private Player $player;
    private float $amount;

    public function __construct(Player $player, float $amount)
    {
        $this->player = $player;
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getDescription(): string
    {
        return "Salary for " . $this->player->getName();
    }
}
