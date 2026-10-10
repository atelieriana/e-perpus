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
                entryFileNames: 'js/[name].js',
            },
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/scss/bootstrap.scss',
                'resources/scss/icons.scss',
                'resources/scss/app.scss',
                'resources/js/extension.js',
                'resources/js/app.js',
                'resources/libs/bootstrap/js/bootstrap.bundle.min.js'
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
                    src: 'resources/libs/jquery',
                    dest: 'js/jquery',
                    rename: { stripBase: true }
                },
                {
                    src: 'resources/libs/datatables.net-bs4/js',
                    dest: 'js/datatables.net-bs4',
                    rename: { stripBase: true }
                },
                {
                    src: 'resources/libs/datatables.net-bs4/css',
                    dest: 'css/datatables.net-bs4',
                    rename: { stripBase: true }
                },
                {
                    src: 'resources/libs/datatables.net',
                    dest: 'js/datatables.net',
                    rename: { stripBase: true }
                },
                {
                    src: 'resources/libs',
                    dest: '',
                },
                {
                    src: 'node_modules/sweetalert2/dist',
                    dest: 'resources/plugins/sweetalert2',
                    rename: { stripBase: true },
                }
            ],
        }),
    ],
});