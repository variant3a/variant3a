const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        screens: {
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1280px',
            '2xl': '1536px',
        },
        container: {
            center: true,
        },
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            'black': '#000000',
            'white': '#ffffff',
            slate: colors.slate,
            slate: colors.slate,
            gray: colors.gray,
            zinc: colors.zinc,
            neutral: colors.neutral,
            stone: colors.stone,
            red: colors.red,
            orange: colors.orange,
            amber: colors.amber,
            yellow: colors.yellow,
            lime: colors.lime,
            green: colors.green,
            emerald: colors.emerald,
            teal: colors.teal,
            cyan: colors.cyan,
            sky: colors.sky,
            blue: colors.blue,
            indigo: colors.indigo,
            violet: colors.violet,
            purple: colors.purple,
            fuchsia: colors.fuchsia,
            pink: colors.pink,
            rose: colors.rose,

            'main': {
                50: '#d3f9ff',
                100: '#b1f4ff',
                200: '#7eecff',
                300: '#29e0ff',
                400: '#00b5d3',
                500: '#0089A0',
                600: '#006C7E',
                700: '#004f5c',
                800: '#00404b',
                900: '#00323a',
            },
        },
        extend: {},
    },
    plugins: [
        [
            'postcss-preset-env',
            {
                // Options
            },
            require('@tailwindcss/typography'),
            // require('@tailwindcss/forms'),
            require('@tailwindcss/aspect-ratio'),
            require('tailwind-scrollbar'),
        ],
    ],
}
