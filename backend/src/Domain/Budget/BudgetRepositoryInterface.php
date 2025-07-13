<?php

namespace App\Domain\Budget;

interface BudgetRepositoryInterface
{
    public function save(Budget $budget): void;
    public function findById(int $id): ?Budget;
}
