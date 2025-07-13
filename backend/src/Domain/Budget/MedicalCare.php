<?php

namespace App\Domain\Budget;

use App\Domain\Player\Player;

class MedicalCare implements Expense
{
    private Player $player;
    private float $amount;
    private string $description;

    public function __construct(Player $player, float $amount, string $description)
    {
        $this->player = $player;
        $this->amount = $amount;
        $this->description = $description;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getDescription(): string
    {
        return "Medical care for " . $this->player->getName() . ": " . $this->description;
    }
}
