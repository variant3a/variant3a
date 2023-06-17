import hljs from 'highlight.js'
import * as Turbo from "@hotwired/turbo"

Turbo.start()

document.addEventListener('turbo:load', () => hljs.highlightAll())

window.addEventListener('load', () => {
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js').
            then(() => {
                //
            }).
            catch((error) => {
                console.warn('ServiceWorker error', error)
            })
    }
})
