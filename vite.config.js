import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js',
        },
    },
    server: {
        host: '0.0.0.0', // Acepta conexiones desde cualquier IP
        port: 5173, // El puerto del servidor de Vite
        hmr: {
            host:      'localhost'         , // La IP de tu computadora servidor
            port: 5173, // Puerto para HMR
        },
    }
});
