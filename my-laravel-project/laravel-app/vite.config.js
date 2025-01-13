import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";
import vuetify from 'vite-plugin-vuetify';

export default defineConfig({
    plugins: [
        vue(),
        vuetify(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        port: 5173,
        host: '0.0.0.0',
        //自宅環境（windows）だと0.0.0.0では参照できないのてoriginでローカル指定
        origin: 'http://127.0.0.1:5173',
    }
});
