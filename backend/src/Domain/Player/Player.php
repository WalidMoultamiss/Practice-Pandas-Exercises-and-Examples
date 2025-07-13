<?php

namespace App\Domain\Player;

class Player
{
    private int $id;
    private string $name;
    private string $position;
    private array $statistics;
    private string $healthStatus;
    private array $injuries;

    public function __construct(string $name, string $position)
    {
        $this->name = $name;
        $this->position = $position;
        $this->statistics = [];
        $this->healthStatus = 'Healthy';
        $this->injuries = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getStatistics(): array
    {
        return $this->statistics;
    }

    public function getHealthStatus(): string
    {
        return $this->healthStatus;
    }

    public function getInjuries(): array
    {
        return $this->injuries;
    }
}
