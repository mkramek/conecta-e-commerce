import {defineConfig} from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    server: {
        host: true,
        hmr: {
            host: "185.157.80.51",
        }
    },
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
})
