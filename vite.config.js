import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin'

export default defineConfig({
    optimizeDeps: {
        include: [
            'livewire-turbolinks',
        ],
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.sass',
                'resources/js/app.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js'
        },
    },
    build: {
        commonjsOptions: {
            include: [
                /livewire-turbolinks/,
                /node_modules/,
            ],
        },
    },
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost'
        },
    },
})
