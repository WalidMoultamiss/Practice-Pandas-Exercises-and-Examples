document.addEventListener('DOMContentLoaded', function() {
    const strategyForm = document.getElementById('strategy-form');
    const strategyList = document.getElementById('strategy-list');
    const strategyIdInput = document.getElementById('strategy-id');
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const assignedPlayersInput = document.getElementById('assigned_players');
    const apiUrl = 'api/strategies';

    async function getStrategies() {
        try {
            const response = await fetch(apiUrl);
            const strategies = await response.json();
            strategyList.innerHTML = '';
            if (strategies.data) {
                strategies.data.forEach(strategy => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <h3>${strategy.name}</h3>
                        <p>${strategy.description}</p>
                        <p><strong>Players:</strong> ${strategy.assigned_players}</p>
                        <button onclick="editStrategy(${strategy.id}, '${strategy.name}', '${strategy.description}', '${strategy.assigned_players}')">Edit</button>
                        <button onclick="deleteStrategy(${strategy.id})">Delete</button>
                    `;
                    strategyList.appendChild(li);
                });
            }
        } catch (error) {
            console.error('Error fetching strategies:', error);
        }
    }

    strategyForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const id = strategyIdInput.value;
        const name = nameInput.value;
        const description = descriptionInput.value;
        const assigned_players = assignedPlayersInput.value;
        const strategy = { name, description, assigned_players };

        let response;
        if (id) {
            strategy.id = id;
            response = await fetch(apiUrl, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(strategy)
            });
        } else {
            response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(strategy)
            });
        }

        if (response.ok) {
            strategyForm.reset();
            strategyIdInput.value = '';
            getStrategies();
        }
    });

    window.editStrategy = (id, name, description, assigned_players) => {
        strategyIdInput.value = id;
        nameInput.value = name;
        descriptionInput.value = description;
        assignedPlayersInput.value = assigned_players;
    };

    window.deleteStrategy = async (id) => {
        if (confirm('Are you sure you want to delete this strategy?')) {
            const response = await fetch(apiUrl, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id })
            });

            if (response.ok) {
                getStrategies();
            }
        }
    };

    getStrategies();
});
