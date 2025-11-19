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
        'principal': '#f96854',
        'secundario': '#052d49',
      },
      fontFamily: {
        'sans': ['Instrument Sans', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
    },
  },
  plugins: [],
}