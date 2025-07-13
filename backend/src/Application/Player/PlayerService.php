<?php

namespace App\Application\Player;

use App\Domain\Player\Player;
use App\Domain\Player\PlayerRepositoryInterface;

class PlayerService
{
    private PlayerRepositoryInterface $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function createPlayer(string $name, string $position): Player
    {
        // For now, we'll just create a new Player object.
        // In the future, we'll use the repository to save it to the database.
        return new Player($name, $position);
    }

    public function getPlayer(int $id): ?Player
    {
        // For now, this is just a placeholder.
        // In the future, we'll use the repository to fetch the player from the database.
        return null;
    }
}
