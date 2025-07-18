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
        const response = await fetch(apiUrl);
        const players = await response.json();
        playerList.innerHTML = '';
        players.data.forEach(player => {
            const li = document.createElement('li');
            li.innerHTML = `
                ${player.name} (${player.position})
                <button onclick="editPlayer(${player.id}, '${player.name}', '${player.position}', '${player.statistics}', '${player.health}', '${player.injuries}')">Edit</button>
                <button onclick="deletePlayer(${player.id})">Delete</button>
            `;
            playerList.appendChild(li);
        });
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

        if (id) {
            player.id = id;
            await fetch(apiUrl, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(player)
            });
        } else {
            await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(player)
            });
        }
        playerForm.reset();
        playerIdInput.value = '';
        getPlayers();
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
        await fetch(apiUrl, {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        });
        getPlayers();
    };

    getPlayers();
});
