const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
const plugin = require('tailwindcss/plugin');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                'screen-90': '90vw',
                'screen-80': '80vw',
                'screen-60': '60vw',
                'screen-50': '50vw',
                'screen-40': '40vw',
                'screen-30': '30vw',
            },
            colors:{
                primary: {
                  100: "#f2f8f9",
                  200: "#e5f1f2",
                  300: "#d8e9ec",
                  400: "#cbe2e5",
                  500: "#bedbdf",
                  600: "#98afb2",
                  700: "#728386",
                  800: "#4c5859",
                  900: "#262c2d"
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),],
};
