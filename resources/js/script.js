import { Tooltip, ScrollSpy, Offcanvas } from 'bootstrap'
import hljs from 'highlight.js'
import Turbolinks from 'turbolinks'
import LivewireTurbolinks from 'livewire-turbolinks'

Turbolinks.start()

document.addEventListener('turbolinks:load', function () {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].map(tooltipTriggerEl => new Tooltip(tooltipTriggerEl))

    OnLoad()
})

document.addEventListener('turbolinks:click', function () {
    const offcanvas = Offcanvas.getInstance(document.querySelector('.offcanvas'))
    offcanvas?.hide()
})

window.addEventListener('paginated', () => {
    OnLoad()
})

window.addEventListener('post-updated', () => {
    hljs.highlightAll()
})

function OnLoad() {
    const dataSpyList = document.querySelectorAll('#post-list');
    [...dataSpyList].map(dataSpyEl => new ScrollSpy(document.body, {
        target: '#post-list'
    }))
    hljs.highlightAll()
}

window.addEventListener('load', () => {
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js').
            then(() => {
                console.log('ServiceWorker registered')
            }).
            catch((error) => {
                console.warn('ServiceWorker error', error)
            })
    }
})
