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
        primary: '#000814',     // Conservée : Noir très foncé
        secondary: '#001d3d',   // Bleu marine très foncé
        tertiary: '#003566',    // Bleu nuit
        quaternary: '#f6cbf4',  // Conservée : Rose pâle
        quinary: '#00a6fb',     // Conservée : Bleu moyen
        senary: '#ffc300',      // Bleu-gris clair pour contraste
      },
    },
  },
  plugins: [],
}
