import Alpine from 'alpinejs'
import persist from '@alpinejs/persist'
import 'livewire-turbolinks'
import './script'
window.Alpine = Alpine

Alpine.plugin(persist)

Alpine.start()
