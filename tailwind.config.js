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

        nav_light:'#0077b6', 
        primary_light: '#48cae4',    
        secondary_light: '#90e0ef',   
        tertiary_light: '#ade8f4',   
        quaternary_light: '#f6cbf4',  
        quinary_light: '#00a6fb',    
        senary_light: '#ffc300', 
      },
    },
  },
  plugins: [themeVariants({
    themes: {
      light: {
        mediaQuery: prefersLight /* "@media (prefers-color-scheme: light)" */,
      },
      dark: {
        mediaQuery: prefersDark /* "@media (prefers-color-scheme: dark)" */,
      },
    },
  }),],
}
