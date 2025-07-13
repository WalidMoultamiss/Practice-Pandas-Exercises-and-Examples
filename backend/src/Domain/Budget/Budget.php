<?php

namespace App\Domain\Budget;

class Budget
{
    private int $id;
    private string $name;
    private float $amount;
    private array $expenses;

    public function __construct(string $name, float $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->expenses = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getExpenses(): array
    {
        return $this->expenses;
    }

    public function addExpense(Expense $expense): void
    {
        $this->expenses[] = $expense;
    }
}
