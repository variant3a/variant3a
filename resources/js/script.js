import { Tooltip, ScrollSpy } from 'bootstrap'
import hljs from 'highlight.js'
import Turbolinks from 'turbolinks'
import LivewireTurbolinks from 'livewire-turbolinks'

Turbolinks.start()

document.addEventListener('turbolinks:load', function () {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].map(tooltipTriggerEl => new Tooltip(tooltipTriggerEl))

    OnLoad()
})

window.addEventListener('paginated', () => {
    OnLoad()
})

function OnLoad() {
    const dataSpyList = document.querySelectorAll('#post-list');
    [...dataSpyList].map(dataSpyEl => new ScrollSpy(document.body, {
        target: '#post-list'
    }))
    hljs.highlightAll()

    twinkleIcon()
}

function twinkleIcon() {
    $('li.nav-item').each(function (i, val) {
        const interval = 500 + i * 70
        const elem = $(this).find('i')
        setTimeout(() => {
            elem.css('transition', '0.2s')
            elem.css('color', 'white')
            setTimeout(() => {
                elem.css('color', '')
                setTimeout(() => {
                    elem.attr('style', '')
                }, 300)
            }, 300)
        }, interval)
    })
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
