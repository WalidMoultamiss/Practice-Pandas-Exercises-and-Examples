<?php

namespace App\Domain\Training;

use App\Domain\Player\Player;

class Training
{
    private int $id;
    private string $name;
    private string $type;
    private \DateTime $date;
    private array $players;

    public function __construct(string $name, string $type, \DateTime $date)
    {
        $this->name = $name;
        $this->type = $type;
        $this->date = $date;
        $this->players = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function addPlayer(Player $player): void
    {
        $this->players[] = $player;
    }
}
