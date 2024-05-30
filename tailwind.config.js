/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#07080d',
        secondary: '#17263a',
        tertiary: '#3d6389',
        quaternary: '#f6cbf4',
        quinary: '#2d78c7',
      },
    },
  },
  plugins: [],
}
