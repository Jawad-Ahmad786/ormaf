import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/config/saas/app.scss', // Path to your SCSS file
                'resources/js/app.js',                // Path to your JS file
            ],
            refresh: true,
        }),
    ],
});
