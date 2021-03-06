const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
  
    theme: {
        extend: {
            fontFamily: {
                sans: ['Quicksand',  ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'sc-blue': '#00050e',
                'sc-grey': '#5B5B5B',
                'sc-black': '#000000',
                'sc-white': '#ffffff',
                'sc-over': '#0000006b'
            }
        }
        
    },

    plugins: [
        require('@tailwindcss/forms'), 
        require('@tailwindcss/typography'),
        plugin(({ addVariant, e }) => {
            addVariant('sidebar-expanded', ({ modifySelectors, separator }) => {
              modifySelectors(({ className }) => `.sidebar-expanded .${e(`sidebar-expanded${separator}${className}`)}`);
            });
          }),
    ],
};
