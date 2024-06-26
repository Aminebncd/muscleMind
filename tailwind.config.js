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

        nav_light: '#083d77', 
        primary_light: '#f0ead6 ',    
        secondary_light: '#f4d35e',   
        tertiary_light: '#ee964b',   
        // quaternary_light: '#C669C2',  
        // quinary_light: '#007BBA',    
        // senary_light: '#DCB126', 
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