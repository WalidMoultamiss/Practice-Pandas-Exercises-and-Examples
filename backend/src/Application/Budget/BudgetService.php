<?php

namespace App\Application\Budget;

use App\Domain\Budget\Budget;
use App\Domain\Budget\BudgetRepositoryInterface;

class BudgetService
{
    private BudgetRepositoryInterface $budgetRepository;

    public function __construct(BudgetRepositoryInterface $budgetRepository)
    {
        $this->budgetRepository = $budgetRepository;
    }

    public function createBudget(string $name, float $amount): Budget
    {
        // For now, we'll just create a new Budget object.
        // In the future, we'll use the repository to save it to the database.
        return new Budget($name, $amount);
    }

    public function getBudget(int $id): ?Budget
    {
        // For now, this is just a placeholder.
        // In the future, we'll use the repository to fetch the budget from the database.
        return null;
    }
}
