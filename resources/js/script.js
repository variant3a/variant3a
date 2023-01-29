import hljs from 'highlight.js/es/common'
import apache from 'highlight.js/es/languages/apache'
import dockerfile from 'highlight.js/es/languages/dockerfile'
import nginx from 'highlight.js/es/languages/nginx'
import powershell from 'highlight.js/es/languages/powershell'
import * as Turbo from "@hotwired/turbo"

hljs.registerLanguage('apache', apache)
hljs.registerLanguage('dockerfile', dockerfile)
hljs.registerLanguage('nginx', nginx)
hljs.registerLanguage('powershell', powershell)

Turbo.start()

document.addEventListener('turbo:load', () => hljs.highlightAll())
Livewire.hook('element.updated', () => hljs.highlightAll())

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
