<?php

namespace App\Domain\GamePlan;

interface GamePlanRepositoryInterface
{
    public function save(GamePlan $gamePlan): void;
    public function findById(int $id): ?GamePlan;
}
