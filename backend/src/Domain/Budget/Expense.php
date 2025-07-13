<?php

namespace App\Domain\Budget;

interface Expense
{
    public function getAmount(): float;
    public function getDescription(): string;
}
