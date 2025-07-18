document.addEventListener("DOMContentLoaded", () => {
    const playerForm = document.getElementById('player-form');
    const playerList = document.getElementById('player-list');
    const playerIdInput = document.getElementById('player-id');
    const nameInput = document.getElementById('name');
    const positionInput = document.getElementById('position');
    const statisticsInput = document.getElementById('statistics');
    const healthInput = document.getElementById('health');
    const injuriesInput = document.getElementById('injuries');

    const apiUrl = 'api/players';

    async function getPlayers() {
        try {
            const response = await fetch(apiUrl);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const players = await response.json();
            playerList.innerHTML = '';
            if (players.data) {
                players.data.forEach(player => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <span>${player.name} (${player.position})</span>
                        <div>
                            <button onclick="editPlayer(${player.id}, '${player.name}', '${player.position}', '${player.statistics}', '${player.health}', '${player.injuries}')">Edit</button>
                            <button onclick="deletePlayer(${player.id})">Delete</button>
                        </div>
                    `;
                    playerList.appendChild(li);
                });
            }
        } catch (error) {
            console.error('Error fetching players:', error);
            alert('Failed to fetch players. Please try again later.');
        }
    }

    playerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = playerIdInput.value;
        const name = nameInput.value;
        const position = positionInput.value;
        const statistics = statisticsInput.value;
        const health = healthInput.value;
        const injuries = injuriesInput.value;
        const player = { name, position, statistics, health, injuries };

        try {
            let response;
            if (id) {
                player.id = id;
                response = await fetch(apiUrl, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(player)
                });
            } else {
                response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(player)
                });
            }

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const result = await response.json();
            alert(result.message);
            playerForm.reset();
            playerIdInput.value = '';
            getPlayers();
        } catch (error) {
            console.error('Error saving player:', error);
            alert('Failed to save player. Please try again later.');
        }
    });

    window.editPlayer = (id, name, position, statistics, health, injuries) => {
        playerIdInput.value = id;
        nameInput.value = name;
        positionInput.value = position;
        statisticsInput.value = statistics;
        healthInput.value = health;
        injuriesInput.value = injuries;
    };

    window.deletePlayer = async (id) => {
        if (confirm('Are you sure you want to delete this player?')) {
            try {
                const response = await fetch(apiUrl, {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const result = await response.json();
                alert(result.message);
                getPlayers();
            } catch (error) {
                console.error('Error deleting player:', error);
                alert('Failed to delete player. Please try again later.');
            }
        }
    };

    getPlayers();
});
