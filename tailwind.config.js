const defaultTheme = require('tailwindcss/defaultTheme');

const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                trueGray: colors.trueGray,
                orange: colors.orange,
                greenLime: colors.lime,
            },
            fontWeight: {
                hairline: 100,
                'extra-light': 100,
                thin: 200,
                 light: 300,
                 normal: 400,
                 medium: 500,
                semibold: 600,
                 bold: 700,
                extrabold: 800,
                'extra-bold': 800,
                 black: 900,
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            fontWeight: ['hover', 'focus'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
