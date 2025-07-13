<?php

namespace App\Domain\Player;

interface PlayerRepositoryInterface
{
    public function save(Player $player): void;
    public function findById(int $id): ?Player;
}
