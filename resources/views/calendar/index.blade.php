<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>

    <x-panel>
        <div id='calendar'></div>
    </x-panel>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/events/calendar',
                editable: true,
                // https://fullcalendar.io/docs/eventDrop
                eventDrop: function (info) {
                    // alert(info.event.title + " was dropped on " + info.event.start.toISOString());

                    // if (!confirm("Are you sure about this change?")) {
                    //     info.revert();
                    // }

                    console.log(info.event.start)
                    console.log(info.event.end)
                    console.log(info.event.allDay)
                    console.log(info.event.extendedProps.is_virtual)

                    if (!info.event.extendedProps.is_virtual) {
                        fetch('http://foo.localhost:8080/api/events/' + info.event.id, {
                            method: "PUT",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({
                                'starts_at': info.event.start.toISOString(),
                                'ends_at': info.event.end.toISOString()
                            }),
                        }).then((resp) => {
                            calendar.refetchEvents()
                        }).catch((err) => {
                            console.log(err)
                            info.revert();
                        })

                        return;
                    }

                    fetch('http://foo.localhost:8080/api/events/' + info.event.id, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            'starts_at': info.event.start.toISOString(),
                            'ends_at': info.event.end.toISOString(),
                            'change_type': prompt('type', 'all')
                        }),
                    }).then((resp) => {
                        calendar.refetchEvents()
                    }).catch((err) => {
                        console.log(err)
                        info.revert();
                    })

                },
                // https://fullcalendar.io/docs/eventResize
                eventResize: function (info) {
                    alert(info.event.title + " end is now " + info.event.end.toISOString());

                    if (!confirm("is this okay?")) {
                        info.revert();
                    }
                },
                // https://fullcalendar.io/docs/eventClick
                eventClick: function (info) {
                    console.log(info);
                    console.log(info.event);
                    // alert('Event: ' + info.event.title);
                    // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    // alert('View: ' + info.view.type);

                    // change the border color just for fun
                    info.el.style.borderColor = 'red';

                    info.jsEvent.preventDefault(); // don't let the browser navigate

                    if (info.event.url) {
                        window.open(info.event.url);
                    }
                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>
