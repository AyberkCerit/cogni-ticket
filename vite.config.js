import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/login.css',
                'resources/js/login.js',
                'resources/css/register.css',
                'resources/js/register.js',
                'resources/css/dashboard.css',
                'resources/js/dashboard.js',
                'resources/css/ticket-create.css',
                'resources/css/tickets.css',
                'resources/js/tickets.js',
                'resources/js/ticket-create.js'
            ],
            refresh: true,
        }),
    ],
});
