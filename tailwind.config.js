const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {

    prefix: 'tw-',

    content: [
        './resources/views/*.blade.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                primary: 'IRANSans',
            },
            keyframes: {
                vibration: {
                    '0%': {transform: 'rotate(50deg)'},
                    '100%': {transform: 'rotate(0deg)'}
                }
            },
            animation:  {
                'vibrating-phone': 'vibration 300ms linear infinite',
            },
            extend: {
                screens: {
                  'lg': '900',
                },
              },
        },

        colors: {
            line: {
                DEFAULT: colors.gray[200],
                dark: colors.gray[700]
            },
            info: {
                light: colors.blue[100],
                DEFAULT: colors.blue[500],
                dark: colors.blue[800],
            },
            success: {
                light: colors.green[100],
                DEFAULT: colors.green[500],
                dark: colors.green[900]
            },
            danger: {
                light: colors.rose[100],
                DEFAULT: colors.rose[500],
                dark: colors.rose[800]
            },
            organization: {
                blue: {
                    100: 'rgb(209 221 255)',
                    900: '#344980'
                },
                yellow: {
                    100: '#fff4b6',
                    900: '#fdd500'
                }
            },
            ...colors
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('tailwind-scrollbar'),

    ],
};
