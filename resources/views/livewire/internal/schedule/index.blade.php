<div wire:ignore>
    <div id="calendar"></div>
    <livewire:internal.schedule.modal :users="$users" />
    @push('js')
        <script defer>
            document.addEventListener('livewire:load', () => {
                const calendarEl = document.getElementById('calendar')
                let calendar = null

                if (calendarEl) {
                    calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                            left: 'customPrev,customNext today',
                            center: 'title',
                            right: 'dayGridMonth,timeGrid listYear'
                        },
                        displayEventTime: true,
                        editable: true,
                        selectable: true,
                        droppable: true,
                        contentHeight: 'auto',
                        nowIndicator: true,
                        customButtons: {
                            customPrev: {
                                icon: 'chevron-left',
                                click: () => {
                                    @this.getEvents(calendar.getDate())
                                    calendar.prev()
                                }
                            },
                            customNext: {
                                icon: 'chevron-right',
                                click: () => {
                                    @this.getEvents(calendar.getDate())
                                    calendar.next()
                                }
                            }
                        },
                        dateClick: info => {
                            const modalEl = document.querySelector('#add-event-modal')
                            const modalWindow = modalEl.firstElementChild
                            let left = 0
                            let top = 0
                            if (info.jsEvent.pageX + 500 > window.innerWidth) {
                                left = info.jsEvent.pageX - (info.jsEvent.pageX + 500 - window.innerWidth)
                            } else {
                                left = info.jsEvent.pageX
                            }
                            if (info.jsEvent.pageY + 648 > window.innerHeight) {
                                top = info.jsEvent.pageX - (info.jsEvent.pageX + 648 - window.innerHeight)
                            } else {
                                top = info.jsEvent.pageY
                            }
                            Livewire.emitTo('internal.schedule.modal', 'showCreateModal', ['Create', left, top, info.dateStr])
                        },
                        eventClick: info => {
                            info.jsEvent.preventDefault()
                            const modalEl = document.querySelector('#add-event-modal')
                            const modalWindow = modalEl.firstElementChild
                            let left = 0
                            let top = 0
                            if (window.innerWidth >= 768) {
                                if (info.jsEvent.pageX + 500 > window.innerWidth) {
                                    left = info.jsEvent.pageX - (info.jsEvent.pageX + 500 - window.innerWidth)
                                } else {
                                    left = info.jsEvent.pageX
                                }
                                if (info.jsEvent.pageY + 648 > window.innerHeight) {
                                    top = info.jsEvent.pageX - (info.jsEvent.pageX + 648 - window.innerHeight)
                                } else {
                                    top = info.jsEvent.pageY
                                }
                            }
                            Livewire.emitTo('internal.schedule.modal', 'showEditModal', ['Edit', left, top, info.event.id])
                        },
                        drop: function(info) {
                            if (checkbox.checked) {
                                info.draggedEl.parentNode.removeChild(info.draggedEl);
                            }
                        },
                        eventDrop: info => @this.moveEvent(info.event, info.oldEvent),
                        loading: function(isLoading) {
                            if (!isLoading) {
                                // Reset custom events
                                this.getEvents().forEach(function(e) {
                                    if (e.source === null) {
                                        e.remove();
                                    }
                                });
                            }
                        }
                    });

                    @this.getEvents(calendar.getDate())

                    calendar.render();

                    Livewire.on(`eventsReceived`, data => {
                        calendar.removeAllEventSources();
                        calendar.addEventSource(data)
                        console.log(data);
                    })
                }
            })
        </script>
    @endpush
</div>
