import { defineConfig, loadEnv  } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import { quasar } from '@quasar/vite-plugin';


export default ({ mode }) => {
    // console.log(loadEnv(mode, 'C:/wamp64/www/shop-latest-backup/', ''));
    process.env = {...process.env, ...loadEnv(mode, path.join(__dirname, "../../"), '')};

    return defineConfig({
        
        plugins: [
            laravel({
                hotFile: '../../storage/vite.hot',
                input: [
                    'resources/js/app.js',
                ],
                ssr: 'resources/js/ssr.js',
                refresh: true
                // publicDirectory: path.join(__dirname, "../../public/"),
                // ssrOutputDirectory: path.join(__dirname, "../../public/build/ssr/")
            }),
    
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
    
            quasar({
                sassVariables: 'resources/css/quasar-variables.sass'
            })
        ],

    /*
        This is we are in a package folder and want to build the files in the application's public path '
     */
    build: {
        outDir: path.join(__dirname, "../../public/build/"),
    },

    /*
        This is because the fonts from boxicons were not loaded due to an error:
        'the request url is outside of Vite serving allow list'
     */
    server: {
        fs: {
            allow: [
                '../../../../'
            ]
        }
    },

    resolve: {
        alias: {
                '@': '/resources/js',
                'root': '../../../../',
                // process: "process/browser",
                // stream: "stream-browserify",
                // zlib: "browserify-zlib",
                // util: 'util'

                // process: "process/browser",
                // buffer: "buffer",
                // crypto: "crypto-browserify",
                // stream: "stream-browserify",
                // assert: "assert",
                // http: "stream-http",
                // https: "https-browserify",
                // os: "os-browserify",
                // url: "url",
                // util: "util",
            },
        },
    });
}
