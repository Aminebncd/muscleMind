/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/*.js",
    "./templates/**/*.html.twig",
    "./src/Form/*.php",
  ],
  theme: {
    extend: {
      colors: {
        nav:'#07080d', 
        primary: '#000814',    
        secondary: '#001d3d',   
        tertiary: '#003566',   
        quaternary: '#f6cbf4',  
        quinary: '#00a6fb',    
        senary: '#ffc300', 
      },
    },
  },
  plugins: [],
}
