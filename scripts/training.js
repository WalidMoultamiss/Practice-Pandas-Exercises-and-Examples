document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const modal = document.getElementById('training-modal');
    const form = document.getElementById('training-form');
    const trainingIdInput = document.getElementById('training-id');
    const typeInput = document.getElementById('type');
    const dateInput = document.getElementById('date');
    const playersInput = document.getElementById('players');
    const apiUrl = 'api/training';

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: async function(fetchInfo, successCallback, failureCallback) {
            try {
                const response = await fetch(apiUrl);
                const data = await response.json();
                const events = data.data.map(session => ({
                    id: session.id,
                    title: session.type,
                    start: session.date,
                    extendedProps: {
                        players_involved: session.players_involved
                    }
                }));
                successCallback(events);
            } catch (error) {
                failureCallback(error);
            }
        },
        dateClick: function(info) {
            openModal(info.dateStr);
        },
        eventClick: function(info) {
            openModal(info.event.startStr, info.event);
        }
    });

    calendar.render();

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const id = trainingIdInput.value;
        const type = typeInput.value;
        const date = dateInput.value;
        const players_involved = playersInput.value;
        const session = { type, date, players_involved };

        let response;
        if (id) {
            session.id = id;
            response = await fetch(apiUrl, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(session)
            });
        } else {
            response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(session)
            });
        }

        if (response.ok) {
            closeModal();
            calendar.refetchEvents();
        }
    });

    window.openModal = function(date, event = null) {
        modal.style.display = 'block';
        dateInput.value = date;
        if (event) {
            trainingIdInput.value = event.id;
            typeInput.value = event.title;
            playersInput.value = event.extendedProps.players_involved;
        }
    };

    window.closeModal = function() {
        modal.style.display = 'none';
        form.reset();
        trainingIdInput.value = '';
    };
});
