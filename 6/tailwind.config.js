/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./**/*.html'],
  theme: {
    screens: {
      sm: '380px',
      ssm: '580px',
      md: '768px',
      lg: '1080px',
      xl: '1440px',
    },
    extend: {
      backgroundImage: {
        'header': "url('/image/header.jpg')",
        'woman': "url('/image/woman.png')",
      }
    },
  },
  plugins: [],
}

