/** @type {import('tailwindcss').Config} */
const { themeVariants } = require("tailwindcss-theme-variants");

module.exports = {
  content: [
    "./assets/*.js",
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

        nav_light: '#2f6a87', 
        primary_light: '#6eb2cc',    
        secondary_light: '#e7e7e7',   
        tertiary_light: '#ade8f4',   
        quaternary_light: '#f6cbf4',  
        quinary_light: '#00a6fb',    
        senary_light: '#ffc300', 
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