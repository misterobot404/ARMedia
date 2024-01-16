import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { splitVendorChunkPlugin } from 'vite'
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    build: {
        chunkSizeWarningLimit: 1000
    },
    plugins: [
        vue(),
        laravel({
            input: ['resources/js/main.js'],
            refresh: true,
        }),
        splitVendorChunkPlugin(),
    ],
});
