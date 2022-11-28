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
        extend: {},
    },
    plugins: [
        [
            "postcss-preset-env",
            {
                // Options
            },
            require('@tailwindcss/typography'),
            require('@tailwindcss/forms'),
            require('@tailwindcss/line-clamp'),
            require('@tailwindcss/aspect-ratio'),
        ],
    ],
}
