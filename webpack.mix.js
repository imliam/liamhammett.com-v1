const glob = require('glob-all');
const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const purgeCss = require('purgecss-webpack-plugin');

mix
    .js('resources/assets/js/app.js', 'public/js')

    .sass('resources/assets/sass/app.scss', 'public/css')

    .options({
        processCssUrls: false,

        postCss: [
            tailwindcss('tailwind.js'),
        ],
    })

    .version()

    .webpackConfig({
        output: {
            chunkFilename: 'js/[name].js',
        },

        plugins: [
            new purgeCss({
                paths: glob.sync([
                    path.join(__dirname, 'app/**/*.php'),
                    path.join(__dirname, 'resources/views/**/*.blade.php'),
                    path.join(__dirname, 'resources/assets/js/**/*.js')
                ]),
                whitelistPatterns: [/carbon/, /language/, /hljs/, /cm-/, /alert-/],
                extractors: [
                    {
                        extractor: class {
                            static extract(content) {
                                return content.match(/[A-z0-9-:\/]+/g) || []
                            }
                        },
                        extensions: ['html', 'js', 'php'],
                    }
                ]
            })
        ],
    });
