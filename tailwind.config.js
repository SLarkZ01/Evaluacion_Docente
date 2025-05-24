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
                poppins: ['Poppins', 'sans-serif'],
            },
            colors: {
                'primary': {
                    100: '#e6ecff',
                    200: '#b3c6ff',
                    300: '#809fff',
                    400: '#4e73df',
                    500: '#3a5fcb',
                    600: '#224abe',
                    700: '#1a3d9f'
                },
                'secondary': {
                    400: '#36b9cc',
                    500: '#2c9faf'
                }
            }
        },
    },

    plugins: [forms],
};
