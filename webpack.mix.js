const mix = require('laravel-mix');
const cssNesting = require('postcss-nesting');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        cssNesting(),
        require('tailwindcss'),
        // require('autoprefixer'), automatic w Laravel Mix 6
    ]);

if (mix.inProduction()) {
    mix.version();
}
