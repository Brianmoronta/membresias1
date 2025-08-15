import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        coopblue: '#0F172A',
        coopgreen: '#84cc16',
        coopgray: '#1e293b',
    },
    },
  },
  plugins: [forms],
}
