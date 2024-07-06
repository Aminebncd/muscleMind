/** @type {import('tailwindcss').Config} */
const { themeVariants } = require("tailwindcss-theme-variants");

module.exports = {
  content: [
    "./assets/*.js",
    "./assets/img/*.svg",
    "./templates/**/*.html.twig",
    "./src/Form/*.php",
  ],
  theme: {
    extend: {
      colors: {
        nav: '#07080d', 
        primary: '#000814',    
        secondary: '#001d3d',   
        tertiary: '#003566',   
        quaternary: '#f6cbf4',  
        quinary: '#00a6fb',    
        senary: '#ffc300', 

        nav_light: '#669bbc', 
        primary_light: '#f0ead6 ',    
        secondary_light: '#f4d35e',   
        tertiary_light: '#ee964b',   
      },
    },
  },
  plugins: [
      themeVariants({
        themes: {
            light: {
                selector: ".light-theme",
            },
            dark: {
                selector: ".dark-theme",
            },
        },
    }),
  ],
}