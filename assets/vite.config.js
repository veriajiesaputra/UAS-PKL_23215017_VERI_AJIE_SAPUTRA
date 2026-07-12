import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
    build: {
        outDir: resolve(__dirname, '../public/assets'),
        emptyOutDir: false,
        rollupOptions: {
            input: {
                admin: resolve(__dirname, 'js/admin.js'),
                landing: resolve(__dirname, 'js/landing.js'),
            },
            output: {
                entryFileNames: 'js/[name].js',
                chunkFileNames: 'js/chunks/[name]-[hash].js',
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name && assetInfo.name.endsWith('.css')) {
                        return 'css/main.css';
                    }
                    return 'assets/[name][extname]';
                },
            },
        },
    },
});
