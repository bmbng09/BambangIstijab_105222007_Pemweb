<!-- Tambahkan CDN FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/main.min.js"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: function(fetchInfo, successCallback, failureCallback) {
                fetch('/event/get-json')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal mengambil data API');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const events = data.map(event => ({
                            id: event.id,
                            title: event.title,
                            start: event.start,
                            end: event.end,
                            color: event.color
                        }));
                        successCallback(events);
                    })
                    .catch(error => {
                        console.error(error);
                        // alert('Gagal memuat data jadwal!');
                    });
            }
        });

        // Render kalender
        calendar.render();
    });
</script>
