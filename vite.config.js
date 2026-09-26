import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    build: {
        manifest: 'manifest.json',
        outDir: 'public/build',
        cssCodeSplit: true,
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name && assetInfo.name.endsWith('.css')) {
                        return 'css/[name]-[hash].min.css';
                    }
                    return 'icons/[name]';
                },
                entryFileNames: 'js/[name].min.js',
            },
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/scss/bootstrap.scss',
                'resources/scss/icons.scss',
                'resources/scss/app.scss',
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/fonts',
                    dest: 'css/custom/plugins/fonts',
                    rename: { stripBase: true },
                },
                {
                    src: 'resources/images',
                    dest: '',
                },
                {
                    src: 'resources/js',
                    dest: '',
                },
                {
                    src: 'resources/libs',
                    dest: '',
                },
            ],
        }),
    ],
});