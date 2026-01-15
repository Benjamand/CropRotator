import laravel from 'laravel-vite-plugin'
import { defineConfig } from 'vite'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            // refresh is only for dev server
        }),
    ],

    base: '/build/',
    build: {
        outDir: 'public/build',
    },

    // No dev server config for production
})
