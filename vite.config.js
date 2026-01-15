import laravel from 'laravel-vite-plugin'
import { defineConfig } from 'vite'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],

    server: {
        host: true, // listen on 0.0.0.0 inside Docker
        port: 5173,
        origin: 'http://localhost:5173', // THIS FIXES THE CORS ERROR
        strictPort: true,
    },
})
