<?php

namespace App\Application\GamePlan;

use App\Domain\GamePlan\GamePlan;
use App\Domain\GamePlan\GamePlanRepositoryInterface;

class GamePlanService
{
    private GamePlanRepositoryInterface $gamePlanRepository;

    public function __construct(GamePlanRepositoryInterface $gamePlanRepository)
    {
        $this->gamePlanRepository = $gamePlanRepository;
    }

    public function createGamePlan(string $name, string $description): GamePlan
    {
        // For now, we'll just create a new GamePlan object.
        // In the future, we'll use the repository to save it to the database.
        return new GamePlan($name, $description);
    }

    public function getGamePlan(int $id): ?GamePlan
    {
        // For now, this is just a placeholder.
        // In the future, we'll use the repository to fetch the game plan from the database.
        return null;
    }
}
