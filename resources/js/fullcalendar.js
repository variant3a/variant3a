document.addEventListener('livewire:load', () => {
    const calendarEl = document.getElementById('calendar')
    let calendar = null

    if (calendarEl) {
        calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'customPrev,customNext today',
                center: 'title',
                right: 'dayGridMonth listYear'
            },
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            displayEventTime: true,
            editable: true,
            selectable: true,
            droppable: true,
            contentHeight: 'auto',
            nowIndicator: true,
            themeSystem: 'standard',
            customButtons: {
                customPrev: {
                    icon: 'chevron-left',
                    click: () => {
                        Livewire.emitTo('internal.schedule.index', 'getEvents', calendar.getDate())
                        calendar.prev()
                    }
                },
                customNext: {
                    icon: 'chevron-right',
                    click: () => {
                        Livewire.emitTo('internal.schedule.index', 'getEvents', calendar.getDate())
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
            drop: function (info) {
                if (checkbox.checked) {
                    info.draggedEl.parentNode.removeChild(info.draggedEl)
                }
            },
            eventDrop: info => Livewire.emitTo('internal.schedule.modal', 'moveEvent', [info.event, info.oldEvent]),
            loading: function (isLoading) {
                if (!isLoading) {
                    // Reset custom events
                    this.getEvents().forEach(function (e) {
                        if (e.source === null) {
                            e.remove()
                        }
                    })
                }
            }
        })

        Livewire.emitTo('internal.schedule.index', 'getEvents', calendar.getDate())

        calendar.render()

        Livewire.on(`eventsReceived`, data => {
            calendar.removeAllEventSources()
            calendar.addEventSource(data)
        })
    }
})
