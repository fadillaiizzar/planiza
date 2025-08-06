/** @type {import('tailwindcss').Config} */

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
     extend: {
      fontFamily: {
        poppins: ['Poppins', 'sans-serif'],
      },
      colors: {
        'off-white': '#F9FAFB',
        'slate-navy': '#1E293B',
        'cool-gray': '#64748B',
        'border-gray': '#CBD5E1',
      },
    },
  },
  plugins: [],
}