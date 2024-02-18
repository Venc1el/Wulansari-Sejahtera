    /** @type {import('tailwindcss').Config} */
export default {
    mode: 'jit',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree'],
            },

            colors: {
                // Define custom colors here
                'primary-green': '#00A89C',
                'primary-yellow' : '#FFC90C'
            },
        },
    },

    plugins: [
        require('flowbite/plugin')
    ],
};
