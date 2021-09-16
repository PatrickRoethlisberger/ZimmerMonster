const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    presets: [
        // the preset merges, fonts, variants, plugins, colors and purge content
        require('./vendor/tanthammar/tall-forms/resources/stubs/tailwindcss/2.0/tall-forms-preset.js'),
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
