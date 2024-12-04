import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                customBlue: '#4D94C7',
                customPurple: '#8589A0',
              },
              backgroundImage: {
                'gradient-custom': 'linear-gradient(to right, #4D94C7, #8589A0)',
              },
        },
    },

    plugins: [forms],
};
