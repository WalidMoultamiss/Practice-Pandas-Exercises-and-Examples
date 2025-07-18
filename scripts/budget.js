document.addEventListener('DOMContentLoaded', function() {
    const totalBudgetSpan = document.getElementById('total-budget');
    const remainingBudgetSpan = document.getElementById('remaining-budget');
    const expenseForm = document.getElementById('expense-form');
    const expenseList = document.querySelector('#expense-list ul');
    const descriptionInput = document.getElementById('description');
    const amountInput = document.getElementById('amount');
    const dateInput = document.getElementById('date');

    const budgetApiUrl = 'api/budget';
    const expensesApiUrl = 'api/expenses';

    async function loadBudgetData() {
        try {
            const response = await fetch(budgetApiUrl);
            const data = await response.json();
            if (data.data.length > 0) {
                const budget = data.data[0];
                totalBudgetSpan.textContent = budget.total_amount;
                remainingBudgetSpan.textContent = budget.current_amount;
            }
        } catch (error) {
            console.error('Error loading budget data:', error);
        }
    }

    async function loadExpenses() {
        try {
            const response = await fetch(expensesApiUrl);
            const data = await response.json();
            expenseList.innerHTML = '';
            if (data.data) {
                data.data.forEach(expense => {
                    const li = document.createElement('li');
                    li.textContent = `${expense.date}: ${expense.description} - $${expense.amount}`;
                    expenseList.appendChild(li);
                });
            }
        } catch (error) {
            console.error('Error loading expenses:', error);
        }
    }

    expenseForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const description = descriptionInput.value;
        const amount = amountInput.value;
        const date = dateInput.value;
        const expense = { description, amount, date };

        try {
            const response = await fetch(expensesApiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(expense)
            });

            if (response.ok) {
                loadBudgetData();
                loadExpenses();
                expenseForm.reset();
            }
        } catch (error) {
            console.error('Error adding expense:', error);
        }
    });

    loadBudgetData();
    loadExpenses();
});
