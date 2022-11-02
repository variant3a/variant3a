import hljs from 'highlight.js'
import * as Turbo from "@hotwired/turbo"

Turbo.start()

document.addEventListener('turbo:load', function () {
    OnLoad()
})

window.addEventListener('paginated', () => {
    OnLoad()
})

window.addEventListener('post-updated', () => {
    hljs.highlightAll()
})

function OnLoad() {
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
