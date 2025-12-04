/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
    "./resources/css/**/*.css",
    "./resources/sass/**/*.scss"
  ],
  theme: {
    extend: {
      colors: {
        principal: {
          DEFAULT: '#f96854', // principal
          dark: '#e65b48',    // principal-dark
          100: '#ffece8',     // light shade for backgrounds
          300: '#ffb5a8',     // medium light shade
          600: '#f96854',     // default
          700: '#e65b48',     // darker shade
          800: '#d34d3c',
        },
        secundario: {
          DEFAULT: '#052d49', // secundario
          dark: '#04273d',    // secundario-dark
          50: '#e1e7eb',      // light shade for backgrounds
          100: '#c3cfd6',
          300: '#869ba6',
          600: '#052d49',     // default
          700: '#04273d',     // darker shade
          800: '#032132',
        },
      },
      fontFamily: {
        'sans': ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
    },
  },
  plugins: [],
}